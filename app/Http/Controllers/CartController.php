<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add($course_id){
        $course = Course::where('id', $course_id)->firstOrFail();
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
}
