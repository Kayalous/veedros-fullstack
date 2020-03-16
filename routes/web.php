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

Route::get('/', function () {
    $courses = \App\Course::get();
    return view('landing', ['courses' => $courses]);
})->name('landing');

//User pages
Route::get('/profile', function () {
    return view('profile',['user' => \Illuminate\Support\Facades\Auth::user()]);
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

Route::group(['middleware' => ['instructor']], function () {

//instructor routes
Route::get('/manage/instructor/courses', 'CourseController@courses')->name('manage.courses');
Route::get('/manage/instructor/courses/new', function (){
    return view('new-course');
})->name('manage.courses.new');
Route::post('/manage/instructor/courses/new', 'CourseController@newCourse')->name('manage.courses.new');
Route::post('/manage/instructor/course/about', 'CourseController@editAbout')->name('manage.courses.about');
Route::post('/manage/instructor/course/price', 'CourseController@editPrice')->name('manage.courses.price');
Route::post('/manage/instructor/course/objective', 'CourseController@editObjective')->name('manage.courses.objective');
Route::post('/manage/instructor/course/recommendation', 'CourseController@editRecommendation')->name('manage.courses.recommendation');
Route::get('/manage/instructor/courses/{slug}', function ($slug){
    $instructor = Auth::user()->instructor;

    if(!$instructor)
        return redirect('/dashboard');

    $course = $instructor->courses()->where('slug', $slug)->firstOrFail();
    return view("courseManagement", ['course'=>$course]);}
    )->name('manage.course.content');
});

Route::post('/manage/instructor/courses/{slug}/thumbnail', 'CourseController@editThumbnail');

//video page
Route::get('/watch/{slug}/{chapterName}/{sessionName}', 'VideoController@watch');

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
