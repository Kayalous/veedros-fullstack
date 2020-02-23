<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verificationToken', 'phone', 'about', 'position',
        'img', 'location', 'twitter', 'facebook', 'linkedin', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function verified()
    {
        return $this->email_verified_at;
    }
    public function socialProviders(){
        return $this->hasMany(SocialProvider::class);
    }
    public function instructor(){
        return $this->hasOne(Instructor::class);
    }
}
