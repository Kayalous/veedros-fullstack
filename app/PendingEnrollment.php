<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PendingEnrollment extends Model
{
    protected $fillable = ['user_id', 'subtotal', 'merchant_order_id', 'paid_at', 'payment_id'];
    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_pending_enrollment');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public static function generateMerchantOrderId(){
        return 'veedpay' .  Str::random(8);
    }

}
