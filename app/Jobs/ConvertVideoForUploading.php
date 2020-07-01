<?php

namespace App\Jobs;

use App\VideosToTranscode;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;
use Symfony\Component\Console\Output\ConsoleOutput;


class ConvertVideoForUploading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $rawVideoFilePath, $videoUrlSavePath, $session_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rawVideoFilePath, $videoUrlSavePath, $session_id)
    {
        $this->rawVideoFilePath = $rawVideoFilePath;
        $this->videoUrlSavePath = $videoUrlSavePath;
        $this->session_id = $session_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $out = new ConsoleOutput();
        $out->writeln("Started video transcoding for " . $this->rawVideoFilePath);
        //Bitrates to encode in
        $lowBitrate = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(800);
        $midBitrate = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(1600);
        $highBitrate = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(2500);
        //Open the video file using FFMPEG
        $rawVideo = FFMpeg::fromDisk('s3')->open($this->rawVideoFilePath);
        $out->writeln("Video downloaded successfully!");
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($lowBitrate)->save($this->videoUrlSavePath . '/360.mp4')
            ->export()->toDisk('s3')->inFormat($midBitrate)->save($this->videoUrlSavePath . '/480.mp4')
            ->export()->toDisk('s3')->inFormat($highBitrate)->save($this->videoUrlSavePath . '/720.mp4');
        $apiResponse = VideosToTranscode::markAsTranscodedAPI($this->session_id);
        if($apiResponse === true)
            $out->writeln("API returned 200! This video transcoding was completed successfully!");
        else
            $out->writeln("API returned an error, but the video was transcoded successfully.");
    }
}
