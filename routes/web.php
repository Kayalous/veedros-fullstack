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
//Route::get('/', function () {
//    return view('testing');
//})->name('testing');
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
Route::get('/manage', function () {
    return view('manage');
})->name('manage');
Route::get('/watch', function () {
    return view('player');
})->name('watch');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('auth/token/{token}', 'AuthController@passwordlessAuthenticate');
