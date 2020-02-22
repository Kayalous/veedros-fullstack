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

Route::get('/', function () {
    return view('landing');
})->name('landing');

//User pages
Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');
Route::get('/profile/{id}', function ($id) {
    return view('profile',['id'=>$id]);
})->name('profile.id');

Route::get('/manage', function () {
    return view('manage');
})->name('manage')->middleware('auth');

Route::post('/manage', 'ManageController@edit')->name('manage')->middleware('auth');
Route::post('/uploadAvatar', 'UploadController@UploadAvatar')->name('upload')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');



//video page
Route::get('/watch/{course}/{section}/{lesson}', 'VideoController@watch');

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


