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

    public $path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lowBitrate = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(800);
        $midBitrate = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(1000);
        $highBitrate = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(2500);
        $UltraHighBitrate = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(5000);

        $rawVideo =FFMpeg::fromDisk('public')->open($this->path);
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($lowBitrate)->save('folder/360p.mp4');
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($midBitrate)->save('folder/480p.mp4');
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($highBitrate)->save('folder/720p.mp4');
        $fmpeg = $rawVideo->export()->toDisk('s3')->inFormat($UltraHighBitrate)->save('folder/1080p.mp4');
        return;
    }
}
