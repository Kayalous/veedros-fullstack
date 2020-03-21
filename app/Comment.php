<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'session_id'];

    public function session(){
        return $this->belongsTo(Session::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
