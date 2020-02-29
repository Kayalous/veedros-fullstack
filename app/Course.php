<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

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
}
