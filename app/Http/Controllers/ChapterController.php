<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function editChapterName(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:500',
        ]);

        $course = Auth::user()->instructor->courses->where('slug', $request['slug'])->first();

        if($request['objId'] !== null){
            $objective = $course->objectives->where('id', $request['objId'])->first();
            $objective->update(['objective' => $request['objective']]);
            return response(['status'=>'Objective has been updated successfully.','id'=> $objective->id], 200);
        }

        else{
            $objective = Objective::create([
                'course_id' => $course->id,
                'objective' => $request['objective']
            ]);
            return response(['status'=>'New objective has been successfully added.','id'=> $objective->id], 200);
        }
    }
}
