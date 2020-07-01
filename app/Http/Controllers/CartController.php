<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Course;
use App\Mail\PendingPaymentMail;
use App\PendingEnrollment;
use App\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function calculateTotal($code){
        $carted = Auth::user()->carted;
        $total = $carted->sum('price');
        if($code){
            //check if discount valid
            $promo = PromoCode::where('code', $code)->first();
            if($promo) {
                //If the promo code can be used
                if(($promo->unlimited || $promo->number_of_uses > 0)){
                    $used = false;
                    //If the code is global
                    if($promo->global) {
                        $total = $carted->sum('price') * (1 - $promo->discount_percentage/100);
                        $used = true;
                    }
                    //If the code isn't global, check each
                    else{
                        $total = 0;
                        foreach ($carted as $course) {
                            if($promo->hasCourse($course)) {
                                $total += $course->price * (1 - $promo->discount_percentage/100);
                                $used = true;
                            }
                            else $total += $course->price;
                        }
                    }
//                        //Promo code used
//                        if(!$promo->unlimited && $used){
//                            $promo->number_of_uses -= 1;
//                            $promo->save();
//                        }
                    session()->now('success','Promo code applied!');
                }
                elseif(!($promo->unlimited || $promo->number_of_uses > 0)) session()->now('failure','The promo code you entered is invalid or expired.');
            }
            elseif(!$promo) session()->now('failure','The promo code you entered is invalid or expired.');
        }
        return $total;
    }
    public function show(Request $request){
        $total = $this->calculateTotal($request['code']);
        return view('cart',['total'=>$total, 'code' => $request['code']]);
    }
    public function add($course_id){
        $course = Course::where('id', $course_id)->firstOrFail();
        if(Auth::user()->courses->contains($course)) return back()->with('message', 'You already own this course.');

        $cartItem = Cart::firstOrCreate([
            'user_id'=>Auth::user()->id,
            'course_id' => $course->id]);
        return back()->with('success', 'Course added to cart!');
    }
    public function remove($course_id){
        $course = Course::where('id', $course_id)->firstOrFail();
        $cartItem = Cart::where([
            'user_id'=>Auth::user()->id,
            'course_id' => $course->id])->first();
        if($cartItem){
            $cartItem->delete();
        }
        return back()->with('success', 'Course removed from cart!');
    }
    public function checkout(Request $request){
        $total = $this->calculateTotal($request['code']);
        $request->session()->forget(['failure', 'success']);
        $enrollment = PendingEnrollment::create([
            'user_id'=>Auth::user()->id,
            'merchant_order_id' => PendingEnrollment::generateMerchantOrderId(),
            'subtotal' => $total
        ]);
        $enrollment->courses()->sync(Auth::user()->carted);
        if($enrollment->subtotal == 0){
            EnrollController::enrollInMultipleCourses(Auth::user(), $enrollment);
            return redirect('/dashboard')->with(['success' => "Thank you for your purchase! Enjoy your courses."]);
        }
        $code = PaymentController::payRequest($enrollment);
        Mail::to(Auth::user())->send(new PendingPaymentMail($enrollment,$code));
        return view('weaccept-code')->with(
                ['enrollment' => $enrollment,
                'amanCode' => $code,
                    'isMail' => false]);
    }

}
