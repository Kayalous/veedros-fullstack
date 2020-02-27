<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
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
            'price' => 'required',
            'genre' => 'required|max:100',
            'about' => 'required|max:500',
        ]);
        $instructor = Auth::user()->instructor;
        //making the slug
        $random = Str::random(5);
        $slug = Str::slug($request['name'] . ' ' . $random, '-');
        //creating course path
        $path = base_path() . '/public';
        fileFacede::makeDirectory($path . '/uploads/courses/'. Auth::user()->id . '/' . $slug .'/images/', 0755, true, true);
        //transferring course image from temp storage to perm storage
        $path = $this->getPathFromServerId($request['filepond']);
        $file = new File($path);
        $newName = time() . '.' . $file->extension();
        $file->move(public_path('uploads/courses/') . Auth::user()->id . '/' . $slug . '/images/', $newName);
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
        $course = Auth::user()->instructor->courses->where('slug', $request['slug'])[0];
        $course->update(['about'=>$request['about']]);
        return response('About has been updated successfully', 200);
    }
}
