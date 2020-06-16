<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingEnrollment extends Model
{
    protected $fillable = ['user_id', 'course_id', 'merchant_order_id'];
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
