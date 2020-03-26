<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['name', 'course_id', 'slug', 'about'];
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function sessions(){
        return $this->hasMany(Session::class);
    }
}
