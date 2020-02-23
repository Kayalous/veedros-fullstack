<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function experince(){
        return $this->hasMany(Experince::class);
    }
}
