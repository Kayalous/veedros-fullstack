<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function sessions(){
        return $this->hasMany(Session::class);
    }
}
