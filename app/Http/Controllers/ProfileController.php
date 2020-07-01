<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visit($id){
        $user = User::where('id',$id)->firstOrFail();
        $courses = null;
        if($user->instructor){
            $courses = $user->instructor->courses()->take(3)->get();
        }
        return view("profile",['user'=>$user, 'courses'=>$courses]);
    }
}
