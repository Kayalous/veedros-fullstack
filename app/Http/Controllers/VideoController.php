<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function watch($course, $section, $lesson){
        return view('player',
                ['course' => $course,
                'section' => $section,
                'lesson' => $lesson]);
    }
}
