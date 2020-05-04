<?php

namespace App\Jobs;

use App\VideosToTranscode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadRawVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tempVideoPath, $videoUrlSavePath, $session;

    /**
     * Create a new job instance.
     *
     * @param $tempVideoPath
     * @param $videoUrlSavePath
     * @param $session
     */
    public function __construct($tempVideoPath, $videoUrlSavePath, $session)
    {
        $this->tempVideoPath = $tempVideoPath;
        $this->videoUrlSavePath = $videoUrlSavePath;
        $this->session = $session;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rawVideoFile = new \Illuminate\Http\File($this->tempVideoPath);
        $rawVideoFilePath = \Illuminate\Support\Facades\Storage::disk('s3')->putFileAs($this->videoUrlSavePath, $rawVideoFile, 'raw.mp4');
        //This is to give the illusion that all the resolutions are uploaded while the processing happens later.
        \Illuminate\Support\Facades\Storage::disk('s3')->delete([$this->videoUrlSavePath . '/360.mp4', $this->videoUrlSavePath . '/480.mp4', $this->videoUrlSavePath . '/720.mp4', $this->videoUrlSavePath . '/1080.mp4']);
        \Illuminate\Support\Facades\Storage::disk('s3')->copy($rawVideoFilePath, $this->videoUrlSavePath . '/360.mp4');
        \Illuminate\Support\Facades\Storage::disk('s3')->copy($rawVideoFilePath, $this->videoUrlSavePath . '/480.mp4');
        \Illuminate\Support\Facades\Storage::disk('s3')->copy($rawVideoFilePath, $this->videoUrlSavePath . '/720.mp4');
        \Illuminate\Support\Facades\Storage::deleteDirectory('temp');
        $rawVideoFilePath = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $rawVideoFilePath;
        $this->session->video->link_raw = $rawVideoFilePath;
        $this->session->video->link_360 = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $this->videoUrlSavePath . '/360.mp4';
        $this->session->video->link_480 = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $this->videoUrlSavePath . '/480.mp4';
        $this->session->video->link_720 = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $this->videoUrlSavePath . '/720.mp4';
        $this->session->video->save();
        $this->session->video->updateVideoDuration();
        VideosToTranscode::add($this->session->video->id);
    }
}
