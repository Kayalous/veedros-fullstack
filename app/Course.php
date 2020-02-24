<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
