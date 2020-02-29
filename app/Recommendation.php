<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = ['course_id', 'recommendation'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
