<?php

namespace App;

use FFMpeg\FFProbe;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['session_id', 'duration', 'duration_seconds', 'link_raw', 'link_360', 'link_480', 'link_720', 'link_1080'];

    public function session(){
        return $this->belongsTo(Session::class);
    }

    public function updateVideoDuration(){
        $ffprobe = FFProbe::create([
            'ffmpeg.binaries'  => env('FFMPEG_BINARIES', 'ffmpeg'),
            'ffprobe.binaries' => env('FFPROBE_BINARIES', 'ffprobe'),
        ]);

        $this->duration_seconds = $ffprobe
            ->format($this->link_raw)
            ->get('duration');
        $this->duration = gmdate("i:s", $this->duration_seconds);
        $this->save();
        $course = $this->session->chapter->course;
        Course::calculateAndSaveTotalRuntime($course);
    }
}
