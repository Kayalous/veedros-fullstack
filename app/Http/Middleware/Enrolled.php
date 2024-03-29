<?php

namespace App\Http\Middleware;

use App\Enroll;
use App\View;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class Enrolled
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $pathInfo = explode('/',$request->getPathInfo());
        $instructorDisplayName = $pathInfo[2];
        $courseSlug = $pathInfo[3];
        $chapterSlug = $pathInfo[4];
        $sessionSlug = $pathInfo[5];
        //Get the course instructor or fail
        $instructor = \App\Instructor::where('display_name', $instructorDisplayName)->firstOrFail();
        //get the course
        $course = $instructor->courses()->where('slug', $courseSlug)->firstOrFail();
        //get the chapter the user requested
        $requestChapter = $course->chapters()->where('slug', $chapterSlug)->firstOrFail();
        //get the session that was requested
        $requestSession = $requestChapter->sessions()->where('slug', $sessionSlug)->firstOrFail();
        //get the first 3 sessions in the course
        $firstSessions = collect();
        foreach ($course->chapters as $chapter){
            if(count($firstSessions) < 3){
                foreach ($chapter->sessions as $session){
                if(count($firstSessions) < 3)
                    $firstSessions->push($session);
                else
                    break;

                }
            }
            else
                break;
        }
        //Assume the user isn't enrolled
        $userIsEnrolled = false;
        //check if the user is logged in
        if(Auth::user()){
            $enrolledStudent = Enroll::where('user_id', Auth::user()->id)->where('course_id', $course->id)->get();
            if(count($enrolledStudent) >= 1)
                $userIsEnrolled = true;
            //if the user was enrolled set 'enrolled' as true (For analytics and stats)
                View::firstOrCreate(['user_id' =>Auth::user()->id, 'session_id' => $requestSession->id, 'course_id' => $course->id, 'enrolled' => $userIsEnrolled]);

        }
        //If not Auth then just get their ip address
        else
            View::firstOrCreate(['session_id' => $requestSession->id, 'course_id' => $course->id, 'ip_address' => $request->ip()]);

        //if the session requested one of the first three sessions or, the user is enrolled in the course let the user watch
        //The conditions are there to not throw errors when the first sessions are less than 3 sessions
        if(count($firstSessions) >= 3){
            if     ($firstSessions[0]->id === $requestSession->id ||
                    $firstSessions[1]->id === $requestSession->id ||
                    $firstSessions[2]->id === $requestSession->id ||
                    $userIsEnrolled)
                    return $next($request);
            //if not then prompt them to enroll and redirect them to the first video
            else{
                Session::flash('message','You need to be enrolled in this course to watch that session.');
                return redirect('watch/' . $instructorDisplayName . '/' . $courseSlug . '/' . $course->chapters[0]->slug . '/' .$firstSessions[0]->slug);
            }
        }
        else
            return $next($request);
    }
}
