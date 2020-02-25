<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['price', 'instructor_id', 'about', 'name', 'slug'];
    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
