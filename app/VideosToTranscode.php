<?php

namespace App;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class VideosToTranscode extends Model
{
    protected $fillable = ['session_id', 'link_raw',  'path', 'transcoded_at'];

    public function session(){
        return $this->hasOne(Session::class);
    }

    //This is so that the admins can easily get a list of all the uploaded videos that haven't
    //been transcoded yet

    //Add a new video to the table
    public static function add($video_id){
        $video = Video::where('id', $video_id)->firstOrFail();
        $session = $video->session;
        $chapter = $session->chapter;
        $course = $chapter->course;
        $instructor = $course->instructor;
        $path = 'courses/uploads/' .  $instructor->display_name . '/' . $course->slug . '/' . $chapter->slug . '/' . $session->slug;
        VideosToTranscode::create(['session_id' => $session->id,
            'link_raw' => $video->link_raw,
            'path' => $path]);
    }


    public static function markAsTranscoded($session_id){
        $session = Session::where('id', $session_id)->firstOrFail();
        $transcoded = VideosToTranscode::where('session_id', $session->id)->firstOrFail();
        $transcoded->transcoded_at = Carbon::now()->toDateTimeString();
        $transcoded->save();
    }
    public static function markAsTranscodedAPI($session_id){
        $client = new Client();
        $res = $client->get('https://veedros.com/api/mark/transcoded/' . $session_id);
        if($res->getStatusCode() === 200)
            return true;
        return false;
    }


}
