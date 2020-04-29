<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class User extends \TCG\Voyager\Models\User implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verificationToken', 'phone', 'about', 'position',
        'avatar', 'img','location', 'twitter', 'facebook', 'linkedin', 'email_verified_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified()
    {
        return $this->email_verified_at;
    }

    public function socialProviders(){
        return $this->hasMany(SocialProvider::class);
    }

    public function instructor(){
        return $this->hasOne(Instructor::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->belongsToMany('App\Comment', 'likes', 'user_id', 'comment_id');
    }

    public function isEnrolledInCourse(Course $course){
        $enrollment = Enroll::where(['user_id' => $this->id, 'course_id' => $course->id])->first();
        if($enrollment !== null)
            return true;
        else
            return false;
    }

    public function courses(){
        return $this->belongsToMany('App\Course', 'enrolls', 'user_id', 'course_id');
    }

    public function saves(){
        return $this->belongsToMany('App\Course', 'saveds', 'user_id', 'course_id');
    }

    public function carted(){
        return $this->belongsToMany('App\Course', 'carts', 'user_id', 'course_id');
    }

    public function views(){
        return $this->hasMany(View::class);
    }

    public function hasSavedThisCourse(Course $course){
        $saved = Saved::where(['course_id' => $course->id, 'user_id' => $this->id])->get();
        if(count($saved) > 0)
            return true;
        return false;
    }

    public function hasSeenThisSession(Session $session){
        $view = View::where(['user_id' => Auth::user()->id, 'session_id' => $session->id])->first();
        if($view)
            return true;
        return false;
    }

    public function getProgressPercentage(Course $course){
        $totalSessionCount = Course::getTotalSessionCount($course);
        $sessionsWatched = View::where(['user_id' => Auth::user()->id, 'course_id' => $course->id])->count();
        return ($sessionsWatched/$totalSessionCount) * 100;
    }

    public function getLastWatchedSession(Course $course){
        $lastView = View::where(['user_id' => Auth::user()->id, 'course_id' => $course->id])->latest()->first();
        if($lastView){
            $lastSessionWatched = Session::where('id', $lastView->session_id)->first();
            //Base url
            $url = URL::to('watch/');
            //With instructor display name
            $url = $url . '/' . $course->instructor->display_name;
            //With course slug
            $url = $url . '/'. $course->slug;
            //With first chapter slug
            $chapter = $lastSessionWatched->chapter;
            $url = $url . '/'. $chapter->slug;
            //With first session slug
            $url = $url . '/'. $lastSessionWatched->slug;
        }
        else{
            $url = Course::getFirstSession($course);
        }
        return $url;
    }
}
