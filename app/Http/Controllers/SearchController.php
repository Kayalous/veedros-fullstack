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
        $results = [];
        $sessions = null;
        $courses = null;
        if($query){
            $sessions = Session::search($query)->get();
            $courses = Course::search($query)->get();
            $results = $courses->merge($sessions)->paginate(10);
        }
        return view('search')->with(['results' => $results]);
    }
}
