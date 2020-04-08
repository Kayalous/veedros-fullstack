<?php

namespace App\Http\Controllers;

use App\LoginToken;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function passwordlessAuthenticate(LoginToken $token){
        Auth::login($token->user);
        $token->delete();
        return back();
    }
}
