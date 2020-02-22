<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class verifyController extends Controller
{
    public function verify($token)
    {
        $user = User::where('verificationToken', $token)->firstOrFail();
        $user->update(['verificationToken' => null,
            'email_verified_at' => Carbon::now()->toDateTimeString()]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Your account has been successfully verified!');
    }
}
