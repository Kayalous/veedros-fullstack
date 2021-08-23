<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursePurchase extends Model
{
    protected $fillable = ['course_id', 'amount', 'payment_id', 'paid_to_instructor_at'];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public static function createPurchases(Payment $payment, PendingEnrollment $enrollment){
        foreach ($enrollment->courses as $course)
            $purchase = CoursePurchase::create([
                'course_id' => $course->id,
                'amount' => $course->priceAfterPromo($enrollment->promo_code),
                'payment_id' => $payment->id,
            ]);
    }
}
