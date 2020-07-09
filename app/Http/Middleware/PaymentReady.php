<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\RegisterController;
use Closure;
use Illuminate\Support\Facades\Auth;

class PaymentReady
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $name = explode(' ',$user->name);
        if(!$user->verified() || !$user->phone || count($name) < 2) {
            if(!$user->verified()) {
                if(RegisterController::getEmailProvider($user->email) !== 'unknown')
                    \Session::flash('inbox-link', RegisterController::getEmailProvider($user->email));

                \Session::flash('success','A link to verify your account was sent to you at ' . $user->email);
                $user->sendEmailVerificationNotification();
            }
            return response()->view('missingData', ['name' => $name]);
        }
        return $next($request);
    }
}
