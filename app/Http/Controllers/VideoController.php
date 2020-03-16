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
        $course = Course::where('slug', $courseSlug)->firstOrFail();
        $chapter = $course->chapters->where('slug', $chapterSlug)->first();
        $session = $chapter->sessions->where('slug', $sessionSlug)->first();
        dd($course);
        return view('player',
                ['course' => $course,
                'section' => $chapter,
                'lesson' => $session]);
    }
}
