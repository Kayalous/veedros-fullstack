<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Comment;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Instructor;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function watch($instructorDisplayName,$courseSlug, $chapterSlug, $sessionSlug){
        $instructor = \App\Instructor::where('display_name', $instructorDisplayName)->firstOrFail();
        $course = $instructor->courses()->where('slug', $courseSlug)->firstOrFail();
        $chapter = $course->chapters()->where('slug', $chapterSlug)->firstOrFail();
        $session = $chapter->sessions()->where('slug', $sessionSlug)->firstOrFail();
        return view('player',
                ['controllerCourse' => $course,
                'controllerChapter' => $chapter,
                'controllerSession' => $session,
                'instructor' => $instructor,
                    ]);
    }
    public function comment(Request $request){
        $validatedData = $request->validate([
            'body' => 'required|max:1000',
        ]);
        if(Auth::user()){
            Comment::create([
                'user_id' => Auth::user()->id,
                'session_id' => $request['session_id'],
                'body' => $request['body']
            ]);
            \Session::flash('success','Your comment was added successfully.');
        }
        else{
            \Session::flash('failure',"You need to be logged in to make a comment.");
            \Session::flash('login-form',"");
        }


        return back();
    }
}
