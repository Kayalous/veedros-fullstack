<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;


class ConvertVideoForUploading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $rawVideoFilePath, $videoUrlSavePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rawVideoFilePath, $videoUrlSavePath)
    {
        $this->rawVideoFilePath = $rawVideoFilePath;
        $this->videoUrlSavePath = $videoUrlSavePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Bitrates to encode in
        $lowBitrate = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(800);
        $midBitrate = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(1600);
        $highBitrate = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(2500);
        //Open the video file using FFMPEG
        $rawVideo = FFMpeg::fromDisk('public')->open($this->rawVideoFilePath);
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($lowBitrate)->save($this->videoUrlSavePath . '/360p.mp4');
//    $rawVideoFilePath = Storage::disk('public')->delete('temp-video',$rawVideoFile);
//        dd($fmpeg);
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($midBitrate)->save($this->videoUrlSavePath . '/480p.mp4');
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($highBitrate)->save($this->videoUrlSavePath . '/720p.mp4');
//        $fmpeg = $rawVideo->export()->toDisk('s3')->save($this->videoUrlSavePath . '/1080p.mp4');
        return;
    }
}
