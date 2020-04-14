<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function foo\func;

class LoginToken extends Model
{
    protected $fillable = ['user_id', 'token'];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public static function generateFor(User $user)
    {
        $token = Str::random(50);
        LoginToken::updateOrCreate([
            'user_id' =>$user->id,
             'token' => $token
        ]);
        return $token;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
