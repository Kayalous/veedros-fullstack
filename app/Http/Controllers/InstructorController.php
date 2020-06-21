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
        return view('courses',['courses' => $courses, 'views' => json_encode($views),
            'enrolls' => json_encode($enrolls), 'viewSum' => $views['total'],
            'enrollSum' => $enrolls['total'],
            ]);
    }

    private function getViews($courses){
        $viewsToReturn = [
            ['count'=>0, 'date'=> Carbon::now()->subDays(30)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(23)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(16)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(9)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(2)->toDateTimeString()],
            'total' => 0];
        if(count($courses) == 0) return $viewsToReturn;

        foreach ($courses as $course){
        $viewsFromLastMonth = $course->views()
            ->where(
                'created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->orderBy('created_at')
            ->select('created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('W');
            });
        $i = 0;
        foreach ($viewsFromLastMonth as $viewsInAWeek){
            $viewsToReturn[$i]['count'] += count($viewsInAWeek);
            $viewsToReturn['total'] += count($viewsInAWeek);
            $i++;
        }
        }

        return $viewsToReturn;
    }

    private function getEnrollments($courses){
        $enrollsToReturn = [['count'=>0, 'date'=> Carbon::now()->subDays(30)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(23)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(16)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(9)->toDateTimeString()],
            ['count'=>0, 'date'=> Carbon::now()->subDays(2)->toDateTimeString()],
            'total' => 0];
        if(count($courses) == 0) return $enrollsToReturn;

        foreach ($courses as $course) {

            $enrollsFromLastMonth = $course->users()
                ->where(
                    'enrolls.created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->orderBy('enrolls.created_at')
                ->select('enrolls.created_at')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('W');
                });

            $i = 0;
            foreach ($enrollsFromLastMonth as $enrollsInAWeek) {
                $enrollsToReturn[$i]['count'] += count($enrollsInAWeek);
                $enrollsToReturn['total'] += count($enrollsInAWeek);
                $i++;
            }
        }
        return $enrollsToReturn;
    }
}
