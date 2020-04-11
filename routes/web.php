<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;

Route::get('/', function () {
    $courses = \App\Course::all()->take(6);
    return view('landing', ['courses' => $courses]);
})->name('landing');

Route::get('/teach', function () {
    return view('teach');
})->name('teach');

Route::post('/teach', 'ContactController@teach')->name('contact.teach');

Route::get('/loaderio-11b75385bde861fbdbbd36ee9a0257cc/', function () {
    return view('stress');
})->name('stress');

Route::get('/academic', function () {
    return view('academies');
})->name('academic');

Route::get('/testing', function () {
    return view('testing');
})->name('testing');
Route::post('/testing/upload', function () {
    dd(request()->file('file')->store('hello-aws', 's3'));
    return back();
})->name('test.upload');


Route::get('/route', function () {
    return view('route');
})->name('route')->middleware('auth');

Route::get('/courses', function () {
    $courses = \App\Course::paginate(6);
    return view('allCourses', ['courses' => $courses]);
})->name('courses');

//User pages
Route::get('/profile', function () {
    return view('profile',['user' => \Illuminate\Support\Facades\Auth::user(), 'courses' => null]);
})->name('profile')->middleware('auth');
Route::get('/profile/{id}','ProfileController@visit')->name('profile.id');
Route::get('/manage', function () {
    return view('manage');
})->name('manage')->middleware('auth');
Route::post('/manage', 'ManageController@edit')->name('manage')->middleware('auth');
Route::post('/uploadAvatar', 'UploadController@UploadAvatar')->name('upload')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');



//instructor routes
Route::group(['middleware' => ['instructor']], function () {
Route::get('/manage/instructor/courses', 'CourseController@courses')->name('manage.courses');
Route::get('/manage/instructor/courses/new', function (){
    return view('new-course');
})->name('manage.courses.new');
Route::post('/manage/instructor/courses/new', 'CourseController@newCourse')->name('manage.courses.new');
Route::post('/manage/instructor/course/about', 'CourseController@editAbout')->name('manage.courses.about');
Route::post('/manage/instructor/course/price', 'CourseController@editPrice')->name('manage.courses.price');
Route::post('/manage/instructor/course/objective', 'CourseController@editObjective')->name('manage.courses.objective');
Route::post('/manage/instructor/course/newChapter', 'CourseController@newChapter')->name('manage.courses.newChapter');
Route::post('/manage/instructor/course/newSession', 'CourseController@newSession')->name('manage.courses.newSession');
Route::post('/manage/instructor/course/newMilestone', 'CourseController@newMilestone')->name('manage.courses.newMilestone');
Route::post('/manage/instructor/course/editChapter', 'CourseController@editChapter')->name('manage.courses.editChapter');
Route::post('/manage/instructor/course/editSession', 'CourseController@editSession')->name('manage.courses.editSession');
Route::post('/manage/instructor/course/editMilestone', 'CourseController@editMilestone')->name('manage.courses.editMilestone');
Route::get('/manage/instructor/course/deleteSession/{id}', 'CourseController@deleteSession')->name('manage.courses.deleteSession');
Route::get('/manage/instructor/course/deleteChapter/{id}', 'CourseController@deleteChapter')->name('manage.courses.deleteChapter');
Route::post('/manage/instructor/course/updateVideoData/{id}', 'CourseController@updateVideoData')->name('manage.courses.updateVideoData');
Route::post('/manage/instructor/course/recommendation', 'CourseController@editRecommendation')->name('manage.courses.recommendation');
Route::get('/manage/instructor/courses/{courseSlug}', function ($courseSlug){
    $instructor = Auth::user()->instructor;

    if(!$instructor)
        return redirect('/dashboard');

    $course = $instructor->courses()->where('slug', $courseSlug)->firstOrFail();
    return view("courseManagement", ['course'=>$course]);}
    )->name('manage.course.content');
Route::get('/manage/instructor/courses/{courseSlug}/advanced', function ($courseSlug){
    $instructor = Auth::user()->instructor;

    if(!$instructor)
        return redirect('/dashboard');

    $course = $instructor->courses()->where('slug', $courseSlug)->firstOrFail();

    return view("courseManagementAdvanced", ['course'=>$course]);}
)->name('manage.course.content.advanced');

Route::post('/manage/instructor/courses/{courseSlug}/{sessionId}/upload-video', function (\Illuminate\Http\Request $request,$courseSlug, $sessionId){

    $session = \App\Session::where('id', $sessionId)->first();
    $chapter = $session->chapter;
    $course = $chapter->course;
    $instructor = $course->instructor;
    $videoUrlSavePath = $instructor->display_name . '/' . $course->slug . '/' . $chapter->slug . '/' . $session->slug;





    //Get file from temp dir
    $filepond = app(Sopamo\LaravelFilepond\Filepond::class);
    $tempVideoPath = $filepond->getPathFromServerId($request['filepond']);
    $rawVideoFile = new \Illuminate\Http\File($tempVideoPath);
    //Save file in public directory so that FFMPEG can access it
    $rawVideoFilePath = Storage::disk('public')->put('temp-video',$rawVideoFile);
    //Dispatch the encode job
    \App\Jobs\ConvertVideoForUploading::dispatch($rawVideoFilePath, $videoUrlSavePath);

    return "okay I'm working. Saving to " . $videoUrlSavePath . ' Started at ' . \Carbon\ Carbon::now()->toTimeString();
});
});



Route::post('/manage/instructor/courses/{slug}/thumbnail', 'CourseController@editThumbnail');

//video page
Route::get('/watch/{instructorDisplayName}/{courseName}/{chapterName}/{sessionName}', 'VideoController@watch')->middleware('enrolled');
Route::post('/comment', 'VideoController@comment');
Route::get('/enroll/{course_id}', 'EnrollController@enroll');
Route::get('/save/{course_id}', 'CourseController@addToSaved');
Route::post('/like/{comment_id}', 'CommentController@like');


//Auth routes
Auth::routes();

//verification routes
Route::get('auth/token/{token}', 'AuthController@passwordlessAuthenticate');
Route::get('auth/verifyaccount/token/{token}', 'verifyController@verify');

//Socialite routes
//facebook
Route::get('auth/facebook', 'Auth\RegisterController@redirectToProviderFacebook')->name('login.facebook');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallbackFacebook');
//google
Route::get('auth/google', 'Auth\RegisterController@redirectToProviderGoogle')->name('login.google');
Route::get('auth/google/callback', 'Auth\RegisterController@handleProviderCallbackGoogle');



//Admin routes
Route::get('/admin/manage/', 'AdminController@show')->name('veedros.admin')->middleware('admin');
Route::get('/admin/manage/add', 'AdminController@add')->name('veedros.admin.add')->middleware('admin');
Route::get('/admin/manage/remove', 'AdminController@remove')->name('veedros.admin.remove')->middleware('admin');
Route::get('/admin/manage/delete', 'AdminController@delete')->name('veedros.admin.delete')->middleware('admin');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();


