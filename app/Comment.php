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
    public function likes(){
        return $this->belongsToMany('App\User', 'likes', 'comment_id', 'user_id');

    }
    public function isLikedBy(User $user){

        $like = Like::where(['user_id' => $user->id, 'comment_id' => $this->id])->first();
        if($like !== null)
            return true;
        return false;
    }

}
