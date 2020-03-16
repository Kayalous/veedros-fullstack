<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use App\Objective;
use App\Recommendation;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as fileFacede;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Sopamo\LaravelFilepond\Exceptions\InvalidPathException;

class CourseController extends Controller
{
    private function getPathFromServerId($serverId) {
        if(!trim($serverId)) {
            throw new InvalidPathException();
        }
        $filePath = Crypt::decryptString($serverId);
        if(!Str::startsWith($filePath, config('filepond.temporary_files_path'))) {
            throw new InvalidPathException();
        }
        return $filePath;
    }
    public function newCourse(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|min:1|max:6',
            'genre' => 'required|max:100',
            'about' => 'required|max:500',
            'filepond' => 'required'
        ]);
        if($request['price'] < 0)
            $request['price'] = 0;
        $instructor = Auth::user()->instructor;
        //making the slug
        $random = Str::random(5);
        $slug = Str::slug($request['name'] . ' ' . $random, '-');
        //creating course path
        $path = base_path() . '/public';
        fileFacede::makeDirectory($path . '/uploads/courses/'. Auth::user()->instructor->id . '/' . $slug .'/images/', 0755, true, true);
        //transferring course image from temp storage to perm storage
        $path = $this->getPathFromServerId($request['filepond']);
        $file = new File($path);
        $newName = time() . '.' . $file->extension();
        $file->move(public_path('uploads/courses/') . Auth::user()->instructor->id . '/' . $slug . '/images/', $newName);
        //create the course
        $course = Course::create(
            ['instructor_id' => $instructor->id,
                'name'=> $request['name'],
                'price' => $request['price'],
                'about' => $request['about'],
                'slug' => $slug,
                'img' => $newName
            ]
        );
        //create the first recommendation
        Recommendation::create([
            'course_id' => $course->id,
            'recommendation' => ''
        ]);
        //create the first objective
        Objective::create([
            'course_id' => $course->id,
            'objective' => ''
        ]);
        //return the new course page
        return redirect('/manage/instructor/courses/'.$slug);

    }
    public function courses(){
        $courses = Auth::user()->instructor->courses;
        return view('courses',['courses' => $courses]);
    }
    public function editAbout(Request $request){
        $validatedData = $request->validate([
            'about' => 'required|max:500',
        ]);

        $course = Auth::user()->instructor->courses->where('slug', $request['slug'])->first();
        $course->update(['about'=>$request['about']]);
        return response('About has been updated successfully.', 200);
    }

    public function editPrice(Request $request){
        $validatedData = $request->validate([
            'price' => 'required|min:1|max:6',

        ]);
        if($request['price'] < 0)
            $request['price'] = 0;

        $course = Auth::user()->instructor->courses->where('slug', $request['slug'])->first();
        $course->update(['price'=>$request['price']]);
        return response('The course price has been updated successfully.', 200);
    }




    public function editThumbnail(Request $request, $slug){
        $validatedData = $request->validate([
            'filepond' => 'required'
        ]);
        $course = Auth::user()->instructor->courses->where('slug', $request['slug'])->first();
        //deleting old picture
        if(\File::exists(public_path('uploads/courses/') . Auth::user()->instructor->id . '/' . $slug . '/images/'. $course->img))
        {
            \File::delete(public_path('uploads/courses/') . Auth::user()->instructor->id . '/' . $slug . '/images/'. $course->img);
        }
        //transferring course image from temp storage to perm storage
        $path = $this->getPathFromServerId($request['filepond']);
        $file = new File($path);
        $newName = time() . '.' . $file->extension();
        $file->move(public_path('uploads/courses/') . Auth::user()->instructor->id . '/' . $slug . '/images/', $newName);
        //update course
        $course->update(['img' => $newName]);
        \Session::flash('success',"Your course's thumbnail was updated successfully.");

        return back();
    }


    public function editObjective(Request $request){
        $validatedData = $request->validate([
            'objective' => 'required|max:500',
            'objId' => 'nullable'
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

    public function editRecommendation(Request $request){
        $validatedData = $request->validate([
            'recommendation' => 'required|max:500',
            'slug' => 'required|max:500',
            'recId' => 'nullable'
        ]);
        $course = Auth::user()->instructor->courses->where('slug', $request['slug'])->first();

        if($request['recId'] !== null){
            $recommendation = $course->recommendations->where('id', $request['recId'])->first();;
            $recommendation->update(['recommendation' => $request['recommendation']]);
            return response(['status'=>'recommendation has been updated successfully.','id'=> $recommendation->id], 200);
        }
        else{
            $recommendation = Recommendation::create([
                'course_id' => $course->id,
                'recommendation' => $request['recommendation']
            ]);
            return response(['status'=>'New recommendation has been successfully added.','id'=> $recommendation->id], 200);
        }

    }

}
