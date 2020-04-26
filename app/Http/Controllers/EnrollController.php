<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enroll;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollController extends Controller
{
    public function enroll($course_id){
        $course = Course::where('id', $course_id)->firstOrFail();
        $user = Auth::user();
        if($user === null)
        {
            \Session::flash('message',"You need to be logged in to enroll in this course.");
            \Session::flash('login-form',"");
            return back();
        }
        $enrollmentStatus = self::enrollUser($user, $course);
        if($enrollmentStatus === true)
            \Session::flash('success',"Awesome! You're now enrolled in " . $course->name .  ".");
        return back();

    }
    public static function enrollUser(User $user, Course $course){
        $newEnroll = Enroll::firstOrCreate(['user_id'=>$user->id,
            'course_id' => $course->id]);
        if($newEnroll->id){
            return true;
        }
        return false;
    }
}
