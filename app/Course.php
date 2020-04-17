<?php

namespace App;

use Carbon\Carbon;
use Facade\Ignition\Exceptions\ViewException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laravel\Scout\Searchable;

class Course extends Model
{
    use Searchable;

    protected $fillable = ['price', 'instructor_id', 'about', 'name', 'slug', 'img', 'duration_seconds', 'duration'];
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

    public function reviews(){
        return $this->hasMany(CourseReview::class);
    }

    public function users(){
        return $this->belongsToMany('App\User', 'enrolls', 'course_id', 'user_id');
    }

    public function saves(){
        return $this->belongsToMany('App\User', 'saveds', 'course_id', 'user_id');
    }

    public function views(){
        return $this->hasMany(View::class);
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

    public static function secs_to_str ($duration)
    {
        if($duration < 60)
        $periods = array(
            'Hour' => 3600,
            'Minute' => 60,
            'Second' => 1
        );
        else
            $periods = array(
                'Hour' => 3600,
                'Minute' => 60
            );

        $parts = array();

        foreach ($periods as $name => $dur) {
            $div = floor($duration / $dur);

            if ($div == 0)
                continue;
            else
                if ($div == 1)
                    $parts[] = $div . " " . $name;
                else
                    $parts[] = $div . " " . $name . "s";
            $duration %= $dur;
        }

        $last = array_pop($parts);

        if (empty($parts))
            return $last;
        else
            return join(', ', $parts) . " and " . $last;
    }

    public static function calculateAndSaveTotalRuntime(Course $course){
        $totalRuntime = 0;
        foreach ($course->chapters as $chapter){
            foreach ($chapter->sessions as $session){
                $video = $session->video;
                $totalRuntime += $video->duration_seconds;
            }
        }
        $totalRuntimeReadable = Course::secs_to_str($totalRuntime);
        $course->update([
            'duration_seconds' => $totalRuntime,
            'duration' => $totalRuntimeReadable]);
    }

    public function hoursOnly(){
        $exploded = explode(' ', $this->duration);
        $hours = $exploded[0] . ' ' . $exploded[1];
        return $hours;
    }

    public function searchableAs()
    {
        return 'Courses';
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
