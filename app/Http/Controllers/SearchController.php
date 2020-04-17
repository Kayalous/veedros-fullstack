<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Course;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SearchController extends Controller
{
    public function search(){
        $query = request()->query('q');
        $courses = null;
        $chapters = null;
        $sessions = null;
        if($query){
            $sessions = Session::search($query)->take(10)->get();
            if(!$sessions){
                $chapters = Chapter::search($query)->take(10)->get();
                if(!$chapters)
                    $courses = Course::search($query)->take(10)->get();
            }
        }
        return view('search')->with(['courses' => $courses, 'chapters' => $chapters, 'sessions' => $sessions]);
    }
}
