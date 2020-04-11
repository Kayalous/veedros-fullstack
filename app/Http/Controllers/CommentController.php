<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function like($commentId){
        $like = Like::where(['comment_id' => $commentId, 'user_id' => Auth::user()->id])->first();
        if($like !== null){
            $like->delete();
            return response(['status'=>'Unliked'], 200);
        }

        $like = Like::create(['comment_id' => $commentId, 'user_id' => Auth::user()->id]);
        if($like !== null){
            return response(['status'=>'Liked'], 200);
        }
    }
}
