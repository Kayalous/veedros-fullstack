<?php

namespace App;

use App\Mail\AdminInvoice;
use App\Mail\PendingPaymentMail;
use App\Mail\StudentInvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Payment extends Model
{
    protected $fillable = ['user_id', 'amount', 'method', 'promo_code_id'];
    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_payment');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function promo_code(){
        return $this->belongsTo(PromoCode::class);
    }

    public function purchases(){
        return $this->hasMany(CoursePurchase::class);
    }

    public static function createPayment(PendingEnrollment $enrollment, $paymentMethod){
        $payment = Payment::create(
            ['user_id' => $enrollment->user->id,
             'amount' => $enrollment->subtotal,
             'method' => $paymentMethod]);

        if($enrollment->promo_code) $payment->promo_code_id = $enrollment->promo_code->id;
        $payment->courses()->sync($enrollment->courses);
        $payment->save();
        return $payment;
    }
    public function notifyUser(){
        Mail::to($this->user)
            ->send(new StudentInvoice($this));
    }
    public function notifyAdmins(){
        Mail::to(User::admins())
            ->send(new AdminInvoice($this));
    }

    public function createPurchases(PendingEnrollment $enrollment){
        $payment = $this;
        foreach ($enrollment->courses as $course)
            $purchase = CoursePurchase::create([
                'course_id' => $course->id,
                'amount' => $course->priceAfterPromo($enrollment->promo_code),
                'payment_id' => $payment->id,
            ]);
    }
}
