<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeVerificationMail;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Sopamo\LaravelFilepond;
use Sopamo\LaravelFilepond\Exceptions\InvalidPathException;

class ManageController extends Controller
{
    public function edit(Request $request){
        $validatedData = $request->validate([
            'name' => 'nullable|max:100',
            'phone' => 'nullable|max:14|min:8',
            'email' => 'nullable|email|max:100',
            'password' => 'nullable|min:8|max:100',
            'position' => 'nullable|max:100',
            'location' => 'nullable|max:100',
            'about' => 'nullable|max:500',
        ]);

        $user = Auth::user();

        if($request['filepond'] != null){
            $this->deleteOldAvatar($user);
            $path = $this->getPathFromServerId($request['filepond']);
            $file = new File($path);
            $newName = time() . '.' . $file->extension();
            $file->move(public_path('uploads/profilePictures'), $newName);
            $request['img'] = $newName;
        }
        if($request['password'] != null)
            $request['password'] = bcrypt($request['password']);

        if($request['email'] != null)
            $request['email'] = strtolower($request['email']);

        $user->update(array_filter($request->all()));

        if($request['email'] != null) {
            $user->update([
                'verificationToken' => Str::random(50),
                'email_verified_at' => null
            ]);
            Mail::to("$user->email")->send(new WelcomeVerificationMail($user));
        }

        return redirect()
            ->route('profile')
            ->with('success', 'Information updated successfully!');

    }


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
    private function deleteOldAvatar($user){
        if(\File::exists(public_path("uploads/profilePictures/") . $user->img) && $user->img !== 'default-avatar.png')
        {
            \File::delete(public_path("uploads/profilePictures/") . $user->img);
        }
    }

    public function courses(){
        $courses = Auth::user()->instructor->courses;
        return view('courses',['courses' => $courses]);
    }

    public function newCourse(Request $request){
        $validatedData = $request->validate([
            'name' => 'nullable|max:100',
            'price' => 'nullable',
            'genre' => 'nullable|max:100',
            'about' => 'nullable|max:500',
        ]);
        $instructor = Auth::user()->instructor;
        //making the slug
        $random = Str::random(5);
        $slug = Str::slug($request['name'] . ' ' . $random, '-');
        //creating course path
        $path = base_path() . '/public';
        File::makeDirectory($path . '/uploads/courses/'. Auth::user()->id . '/' . $slug .'/images/', 0755, true, true);
        //transferring course image from temp storage to perm storage
        $path = $this->getPathFromServerId($request['filepond']);
        $file = new \Illuminate\Http\File($path);
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
}
