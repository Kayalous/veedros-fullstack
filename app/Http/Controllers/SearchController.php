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
        if(request()->query('query'))
            $query = request()->query('query');
        $courses = null;
        $chapters = null;
        $sessions = null;
        if($query){
            $sessions = Session::search($query)->paginate(10);
            if(!$sessions){
                $chapters = Chapter::search($query)->paginate(10);
                if(!$chapters)
                    $courses = Course::search($query)->paginate(10);
            }
        }
        return view('search')->with(['courses' => $courses, 'chapters' => $chapters, 'sessions' => $sessions]);
    }
}
