<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Course;
use App\Http\Controllers\Controller;
use App\Objective;
use App\Recommendation;
use App\Saved;
use App\Session;
use App\Video;
use Faker\Factory as Faker;
use FFMpeg\FFProbe;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as fileFacede;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
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
        $slug = Str::slug($request['name'], '-');
        //creating course path
        $path = base_path() . '/public';
        fileFacede::makeDirectory($path . '/uploads/courses/'. Auth::user()->instructor->id . '/' . $slug .'/images/', 0755, true, true);
        //transferring course image from temp storage to perm storage
        $path = $this->getPathFromServerId($request['filepond']);
        $file = new File($path);
        $fileUrl = Storage::disk('s3')->put('courses/' . Auth::user()->instructor->id . '/' . $slug . '/images', $file);
        $fileUrl = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $fileUrl;
        $request['img'] = $fileUrl;
        //create the course
        $course = Course::create(
            ['instructor_id' => $instructor->id,
                'name'=> $request['name'],
                'price' => $request['price'],
                'about' => $request['about'],
                'slug' => $slug,
                'img' => $request['img']
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
        //create the first chapter
        $chapter = Chapter::create([
            'course_id' => $course->id,
            'name' => "Introduction",
            'slug' => Str::slug($course->name . "'s first chapter", '-'),
            'about' => $course->name . "'s first chapter description",
        ]);
        //create the first session
        $session = Session::create([
            'chapter_id' => $chapter->id,
            'name' => "Introduction",
            'slug' => Str::slug($course->name . "'s first session", '-'),
            'about' => $course->name . "'s session description",
        ]);

        $video = Video::create([
            'session_id' => $session->id
        ]);
        $faker = Faker::create();
        $title = $faker->sentence(4);
        $body = $faker->paragraph(4);
        $objective = Objective::create([
            'session_id' => $session->id,
            'title' => $title,
            'objective' => $body
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
//        if(\File::exists(public_path('uploads/courses/') . Auth::user()->instructor->id . '/' . $slug . '/images/'. $course->img))
//        {
//            \File::delete(public_path('uploads/courses/') . Auth::user()->instructor->id . '/' . $slug . '/images/'. $course->img);
//        }
        //transferring course image from temp storage to perm storage
        $path = $this->getPathFromServerId($request['filepond']);
        $file = new File($path);
        $fileUrl = Storage::disk('s3')->put('courses/' . Auth::user()->instructor->id . '/' . $slug . '/images', $file);
        $fileUrl = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $fileUrl;
        $request['img'] = $fileUrl;
        //update course
        $course->update(['img' => $request['img']]);
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

    public function addToSaved($course_id){
        $course = Course::where('id', $course_id)->firstOrFail();
        $user = Auth::user();
        if($user === null)
        {
            //The user is not signed in
            \Session::flash('message',"You need to be logged in to save this course.");
            \Session::flash('login-form',"");
            return back();
        }
        $saved = Saved::where(['course_id' => $course->id, 'user_id' => $user->id])->get();
        if(count($saved) > 0)
        {
            Saved::destroy($saved[0]->id);
            \Session::flash('success',"Unsaved!");
            return back();
        }
        Saved::firstOrCreate(['course_id' => $course->id, 'user_id' => $user->id]);
        \Session::flash('success',"Saved!");
        return back();

    }

    public function newChapter(Request $request){
        $course = Auth::user()->instructor->courses->where('slug', $request['course_slug'])->first();

        $faker = Faker::create();
        //random chapter values
        $randomName = $faker->name;
        $about = $faker->colorName;
        $slug = Str::slug($randomName, '-');
        $chapter = Chapter::create(['course_id' => $course->id,
            'name' => $randomName,
            'slug' => $slug,
            'about' => $about]);
        //new random values for the session
        $randomName = $faker->name;
        $about = $faker->colorName;
        $slug = Str::slug($randomName, '-');
        $session = Session::create(['chapter_id' => $chapter->id,
            'name' => $randomName,
            'slug' => $slug,
            'link' => 'link']);
        $video = Video::create([
            'session_id' => $session->id
        ]);

        $title = $faker->sentence(4);
        $body = $faker->paragraph(4);
        $objective = Objective::create([
            'session_id' => $session->id,
            'title' => $title,
            'objective' => $body
        ]);
        return response(['status'=>'New chapter has been successfully added.','chapterId'=> $chapter->id, 'sessionId' => $session->id], 200);

    }

    public function newSession(Request $request)
    {
        $course = Auth::user()->instructor->courses->where('slug', $request['course_slug'])->first();

        $chapter = $course->chapters->where('id', $request['chapterId'])->first();

        $faker = Faker::create();
        //new random values for the session
        $randomName = $faker->sentence(3);
        $about = $faker->paragraph(1);
        $slug = Str::slug($randomName, '-');

        $session = Session::create(['chapter_id' => $chapter->id,
            'name' => $randomName,
            'slug' => $slug,
            'about' => $about]);

        $video = Video::create([
            'session_id' => $session->id
        ]);

        $title = $faker->sentence(4);
        $body = $faker->paragraph(4);
        $objective = Objective::create([
            'session_id' => $session->id,
            'title' => $title,
            'objective' => $body
        ]);
        return response(['status' => 'New session has been successfully added.', 'chapterId' => $chapter->id, 'sessionId' => $session->id, 'session' => $session], 200);
    }

    public function newMilestone(Request $request)
    {
        $course = Auth::user()->instructor->courses->where('slug', $request['course_slug'])->first();
        $session = Session::where('id', $request['session_id'])->first();
        $faker = Faker::create();
        $objective = Objective::create([
            'session_id' => $session->id,
            'title' =>$faker->name,
            'objective' => $faker->paragraph()
        ]);
        return response(['status'=>'New milestone has been successfully added.'], 200);
    }

    public function editChapter(Request $request){
        $validatedData = $request->validate([
            'name' => 'nullable|max:500',
            'about' => 'nullable|max:500',
            'chapterId' => 'required'
        ]);
        $chapter = Chapter::where('id', $request['chapterId'])->first();
        if($request['name']){
            $slug = Str::slug($request['name'], '-');
            $chapter->update(['name' => $request['name'],
                'slug' => $slug]);
            return response(['status'=>'Chapter name has been updated successfully.'], 200);
        }
        if($request['about']){
            $chapter->update(['about' => $request['about']]);
            return response(['status'=>'Chapter description has been updated successfully.'], 200);
        }
        return response(['status'=>'No value entered'], 500);
    }

    public function editSession(Request $request){
        $validatedData = $request->validate([
            'name' => 'nullable|max:500|min:1',
            'about' => 'nullable|max:500|min:1',
            'sessionId' => 'required'
        ]);
        $session = Session::where('id', $request['sessionId'])->first();
        if($request['name']){
            $slug = Str::slug($request['name'], '-');
            $session->update(['name' => $request['name'],
                'slug' => $slug]);
            return response(['status'=>'Session name has been updated successfully.'], 200);
        }
        if($request['about']){
            $session->update(['about' => $request['about']]);
            return response(['status'=>'Session description has been updated successfully.'], 200);
        }
        return response(['status'=>'No value entered'], 500);

    }

    public function editMilestone(Request $request){
        $validatedData = $request->validate([
            'title' => 'nullable|max:500',
            'objective' => 'nullable|max:500',
            'objectiveId' => 'required'
        ]);
        $objective = Objective::where('id', $request['objectiveId'])->first();
        if($request['title']){
            $objective->update(['title' => $request['title']]);
            return response(['status'=>'Milestone title has been updated successfully.'], 200);
        }
        if($request['objective']){
            $objective->update(['objective' => $request['objective']]);
            return response(['status'=>'Milestone body has been updated successfully.'], 200);
        }
        return response(['status'=>'No value entered'], 500);
    }

    public function deleteSession($id){
        $session = Session::where('id', $id)->first();
        $session->delete();
        return back()->with('success', 'Session deleted successfully.');
    }

    public function deleteChapter($id){
        $chapter = Chapter::where('id', $id)->first();
        $sessions = $chapter->sessions;
        foreach ($sessions as $session){
            $session->delete();
        }
        $chapter->delete();
        return back()->with('success', "This chapter and all it's sessions were deleted successfully.");
    }

    public function updateVideoData(Request $request, $videoId, $courseId){
        $validatedData = $request->validate([
            'link_360' => 'nullable|max:1000',
            'link_480' => 'nullable|max:1000',
            'link_720' => 'nullable|max:1000',
        ]);
        $ffprobe = FFProbe::create([
            'ffmpeg.binaries'  => env('FFMPEG_BINARIES', 'ffmpeg'),
            'ffprobe.binaries' => env('FFPROBE_BINARIES', 'ffprobe'),
            ]);
        if($request['link_360'])
            $request['duration_seconds'] = $ffprobe
                ->format($request['link_360'])
                ->get('duration');
        elseif ($request['link_480'])
            $request['duration_seconds'] = $ffprobe
                ->format($request['link_480'])
                ->get('duration');
        elseif ($request['link_720'])
            $request['duration_seconds'] = $ffprobe
                ->format($request['link_720'])
                ->get('duration');
        $request['duration'] = gmdate("i:s", $request['duration_seconds']);
        $video = Video::where('id', $videoId)->first();
        $video->update(array_filter($request->all()));
        $course = Course::where('id', $courseId)->first();
        Course::calculateAndSaveTotalRuntime($course);
        return back()->with('success', 'Video information updated successfully.');
    }


}
