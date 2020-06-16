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
        if(count($courses) == 0) return null;
        $viewsFromLastMonth = $courses[0]->views()
            ->where(
                'created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->orderBy('created_at')
            ->select('created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('W');
            });
        $viewsToReturn = [
            ['count'=>0, 'date'=> Carbon::now()->subDays(30)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(23)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(16)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(9)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(2)->toDateTimeString()]];
        $i = 0;
        foreach ($viewsFromLastMonth as $viewsInAWeek){
            $viewsToReturn[$i]['count'] = count($viewsInAWeek);
            $i++;
        }
        return json_encode($viewsToReturn);
    }

    private function getEnrollments($courses){
        if(count($courses) == 0) return null;
        $enrollsFromLastMonth = $courses[0]->users()
            ->where(
                'enrolls.created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->orderBy('enrolls.created_at')
            ->select('enrolls.created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('W');
            });
        $enrollsToReturn = [['count'=>0, 'date'=> Carbon::now()->subDays(30)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(23)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(16)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(9)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(2)->toDateTimeString()]];
        $i = 0;
        foreach ($enrollsFromLastMonth as $enrollsInAWeek){
            $enrollsToReturn[$i]['count'] = count($enrollsInAWeek);
            $i++;
        }
        return json_encode($enrollsToReturn);
    }
}
