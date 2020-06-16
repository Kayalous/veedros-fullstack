<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function courses(){
        $courses = Auth::user()->instructor->courses;
        $views = $this->getViews($courses);
        $enrolls = $this->getEnrollments($courses);
        return view('courses',['courses' => $courses, 'views' => $views, 'enrolls' => $enrolls]);
    }

    private function getViews($courses){
        $viewsFromLastMonth = $courses[0]->views()
            ->where(
                'created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->orderBy('created_at')
            ->select('created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('W');
            });
        $viewsToReturn = [];
        $i = 0;
        foreach ($viewsFromLastMonth as $viewsInAWeek){
            $viewsToReturn[$i]['count'] = count($viewsInAWeek);
            $viewsToReturn[$i]['date'] = $viewsInAWeek[0]->created_at;
            $i++;
        }
        return json_encode($viewsToReturn);
    }

    private function getEnrollments($courses){
//        dd($courses[0]->users);
        $enrollsFromLastMonth = $courses[0]->users()
            ->where(
                'enrolls.created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->orderBy('enrolls.created_at')
            ->select('enrolls.created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('W');
            });
        $enrollsToReturn = [];
        $i = 0;
        foreach ($enrollsFromLastMonth as $enrollsInAWeek){
            $enrollsToReturn[$i]['count'] = count($enrollsInAWeek);
            $enrollsToReturn[$i]['date'] = $enrollsInAWeek[0]->created_at;
            $i++;
        }
        return json_encode($enrollsToReturn);
    }
}
