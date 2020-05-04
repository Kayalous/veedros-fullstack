<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\Session;
use App\SocialProvider;
use App\User;
use App\VideosToTranscode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class AdminController extends Controller
{
    public function show()
    {
        $users = User::all();
        return view('admin', ['users' => $users]);
    }

    //adds a new instructor
    public function add(Request $request)
    {
        $user = User::where('id', $request["id"])->firstOrFail();
        $random = \Illuminate\Support\Str::random(5);
        $displayName = $user->name . ' ' . $random;
        $displayName = \Illuminate\Support\Str::slug($displayName, '-');
        Instructor::firstOrCreate([
            'user_id' => $request["id"],
            'display_name' => $displayName
        ]);
        return back();
    }

    //deletes an already existing instructor
    public function remove(Request $request)
    {
        Instructor::destroy($request["id"]);
        return back();
    }

    //deletes user
    public function delete(Request $request)
    {
        $user = User::where('id', $request["id"]);
        $providers = SocialProvider::where('user_id', $request["id"]);
        $providers->delete();
        $user->delete();
        return back();
    }

    public function transcodeAll()
    {
        $backlog = VideosToTranscode::where('transcoded_at', null)->get();

        foreach ($backlog as $videoToEncode) {
            //Dispatch the encode job
            $session = Session::where('id', $videoToEncode->session_id)->first();
            if($session !== null)
                \App\Jobs\ConvertVideoForUploading::dispatch($videoToEncode->path .'/raw.mp4', $videoToEncode->path, $session->video->id);
            else
                $videoToEncode->delete();
        }
        if(count($backlog) > 0)
            $message = 'All good boss, processing now!';
        else
            $message = 'Nothing to transcode!';

        return redirect('/')->with('success', $message);
    }
}
//dd($s3_file);
////            $session = \App\Session::where('id', $videoToEncode->session_id)->first();
////            $chapter = $session->chapter;
////            $course = $chapter->course;
////            $instructor = $course->instructor;
////            $videoUrlSavePath = $instructor->display_name . '/' . $course->slug . '/' . $chapter->slug . '/' . $session->slug;
////            //Get file from temp dir
////            $filepond = app(Sopamo\LaravelFilepond\Filepond::class);
////            $tempVideoPath = $filepond->getPathFromServerId($request['filepond']);
