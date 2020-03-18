<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Course;
use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function watch($courseSlug, $chapterSlug, $sessionSlug){
        $chapter = Chapter::where('slug', $chapterSlug)->firstOrFail();
        $course = Course::where('slug', $courseSlug)->firstOrFail();
        $session = Session::where('slug', $sessionSlug)->firstOrFail();
        return view('player',
                ['controllerCourse' => $course,
                'controllerChapter' => $chapter,
                'controllerSession' => $session]);
    }
}
