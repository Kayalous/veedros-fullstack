<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;

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
    public function hasSavedThisCourse(Course $course){
        $saved = Saved::where(['course_id' => $course->id, 'user_id' => $this->id])->get();
        if(count($saved) > 0)
            return true;

        return false;

    }
}
