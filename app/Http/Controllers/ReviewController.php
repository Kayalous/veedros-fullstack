<?php

namespace App\Http\Controllers;

use App\CourseReview;
use App\SiteReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(Request $request){
        $validatedData = $request->validate([
            'body' => 'nullable|max:500',
            'rating' => 'required|min:1|max:5']);
        $review = SiteReview::where(['user_id' =>Auth::user()->id])->first();
        if($review)
            $review->update(['body' => $request->body,
                'rating' => (int)$request->rating]);
        else
        $review = SiteReview::firstOrCreate(['body' => $request->body,
            'rating' => (int)$request->rating,
            'user_id'=> Auth::user()->id]);
        return back()->with('success', 'Thank you for your feedback!');
    }

    public function courseReview(Request $request){
        $validatedData = $request->validate([
            'body' => 'nullable|max:500',
            'rating' => 'required|min:1|max:5',
            'course_id' => 'required']);
        $review = CourseReview::where(['user_id' =>Auth::user()->id,
            'course_id'=>$request->course_id])->first();
        if($review)
            $review->update(['body' => $request->body,
                'rating' => (int)$request->rating]);
        else
            $review = CourseReview::firstOrCreate(['body' => $request->body,
                'rating' => (int)$request->rating,
                'user_id'=> Auth::user()->id,
                'course_id'=>$request->course_id]);
        return back()->with('success', 'Thank you for your feedback!');
    }
}
