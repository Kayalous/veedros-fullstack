<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    protected $fillable = ['user_id', 'experince_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function experince(){
        return $this->hasMany(Experince::class);
    }
    public function courses(){
        return $this->hasMany(Course::class);
    }
}
