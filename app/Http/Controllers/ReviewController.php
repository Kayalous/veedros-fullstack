<?php

namespace App\Http\Controllers;

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
}
