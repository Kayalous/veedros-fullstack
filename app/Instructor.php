<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    protected $fillable = ['user_id', 'experince_id', 'display_name'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function experince(){
        return $this->hasMany(Experince::class);
    }
    public function courses(){
        return $this->hasMany(Course::class);
    }
    public function views(){
        $viewCount = 0;
        foreach ($this->courses as $course) $viewCount += $course->views()->count();
        return $viewCount;
    }
    public function enrollments(){
        $enrollmentCount = 0;
        foreach ($this->courses as $course) $enrollmentCount += $course->users()->count();
        return $enrollmentCount;
    }
}
