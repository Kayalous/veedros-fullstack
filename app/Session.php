<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Laravel\Scout\Searchable;

class Session extends Model
{
    use Searchable;

    protected $fillable = ['name', 'chapter_id', 'link', 'slug', 'about', 'duration'];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
    public function trans(){
        return $this->belongsTo(VideosToTranscode::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function objectives(){
        return $this->hasMany(Objective::class);
    }
    public function video(){
        return $this->hasOne(Video::class);
    }
    public function views(){
        return $this->hasMany(View::class);
    }

    public function getLink(){
        $chapter = $this->chapter;
        $course = $chapter->course;
        //Base url
        $url = URL::to('watch/');
        //With instructor display name
        $url = $url . '/' . $course->instructor->display_name;
        //With course slug
        $url = $url . '/'. $course->slug;
        //With first chapter slug
        $url = $url . '/'. $chapter->slug;
        //With first session slug
        $url = $url . '/'. $this->slug;
        return $url;
    }
    public function isFirstSession(){
        $chapter = $this->chapter()->first();
        $course = $chapter->course()->first();
        $firstChapter = $course->chapters()->first();
        $firstSession = $firstChapter->sessions()->first();
        if($firstSession->id === $this->id)
            return false;
        else
            return true;
    }
    public function searchableAs()
    {
        return 'Sessions';
    }
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->name,
            'description' => $this->about,
        ];
    }

}
