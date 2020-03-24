<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable = ['course_id', 'objective'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function session(){
        return $this->belongsTo(Session::class);
    }
}
