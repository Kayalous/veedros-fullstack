<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TusPhp\Request;

class Enroll extends Model
{
    protected $fillable = ['user_id', 'course_id'];
    public static function enroll(Request $request){

    }
    public static function enrollUser(User $user, Course $course){
        $newEnroll = Enroll::firstOrCreate(['user_id'=>$user->id,
            'course_id' => $course->id]);
        if($newEnroll->id){
            return true;
            \Session::flash('success',"Awesome! you're now enrolled in " . $course->name .  ".");

        }
        return false;
    }
}
