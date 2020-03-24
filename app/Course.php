<?php

namespace App;

use Facade\Ignition\Exceptions\ViewException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Course extends Model
{
    protected $fillable = ['price', 'instructor_id', 'about', 'name', 'slug', 'img'];
    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function objectives(){
        return $this->hasMany(Objective::class);
    }
    public function recommendations(){
        return $this->hasMany(Recommendation::class);
    }

    public function users(){
        return $this->belongsToMany('App\User', 'enrolls', 'course_id', 'user_id');
    }

    public function saves(){
        return $this->belongsToMany('App\User', 'saveds', 'course_id', 'user_id');
    }

    public static function getFirstSession(Course $course){
            //Base url
            $url = URL::to('watch/');
            //With instructor display name
            $url = $url . '/' . $course->instructor->display_name;
            //With course slug
            $url = $url . '/'. $course->slug;
            //With first chapter slug
            $firstChapter = $course->chapters()->firstOrFail();
            $url = $url . '/'. $firstChapter->slug;
            //With first session slug
            $firstSession = $firstChapter->sessions()->firstOrFail();
            $url = $url . '/'. $firstSession->slug;
            return $url;
    }
    public static function getTotalSessionCount(Course $course){
        $sessionCount = 0;
        foreach ($course->chapters as $chapter){
            $sessionCount += $chapter->sessions->count();
        }
        return $sessionCount;
    }
}
