<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class PromoCodeController extends Controller
{
    public function redeem(Request $request){
        $promocode = PromoCode::where('code', $request->code)->first();
        if($promocode){
            if($promocode->number_of_uses > 0 || $promocode->unlimited){
                if($promocode->discount_percentage === 100)
                {
                    if(count($promocode->courses) >= 1 || $promocode->unlimited){
                        foreach ($promocode->courses as $course)
                            EnrollController::enrollUser(Auth::user(), $course);
                        if(count($promocode->courses) > 1)
                            Session::flash('success',"Awesome! You're now enrolled in " . $promocode->courses[0]->name .  ", and " . (count($promocode->courses) - 1) . " more courses!");
                        else
                            Session::flash('success',"Awesome! You're now enrolled in " . $promocode->courses[0]->name .  ".");
                    }
                    if(!$promocode->unlimited)
                    {
                        $promocode->number_of_uses -= 1;
                        $promocode->save();
                    }
                }
            }
            else
                Session::flash('failure',"The Promo code you entered is either expired, or doesn't exist.");
        }
        else
            Session::flash('failure',"The Promo code you entered is either expired, or doesn't exist.");

        return back();
    }
}
