<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\SocialProvider;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(){
        $users = User::all();
        return view('admin', ['users' => $users]);
    }
    //adds a new instructor
    public function add(Request $request){
        Instructor::firstOrCreate([
            'user_id' => $request["id"]
        ]);
        return back();
    }
    //deletes an already existing instructor
    public function remove(Request $request){
        Instructor::destroy($request["id"]);
        return back();
    }
    //deletes user
    public function delete(Request $request){
        $user = User::where('id', $request["id"]);
        $providers = SocialProvider::where('user_id', $request["id"]);
        $providers->delete();
        $user->delete();
        return back();
    }
}
