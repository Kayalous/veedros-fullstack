<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visit($id){
        $user = \App\User::where('id',$id)->firstOrFail();
        return view("profile",['user'=>$user]);
    }
}
