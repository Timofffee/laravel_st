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
    return view('welcome');
});

Auth::routes();

Route::get('home', 'UserController@index')->name('home')->middleware('auth');
Route::get('user', function () {
    return redirect('home');
});

Route::get('user/{id}', 'UserController@index')->name('user');

Route::post('comment/new_comment', 'CommentController@new')->name('new_comment')->middleware('auth');
// Route::post('comment/new_comment/{id}', 'CommentController@new')->name('new_comment_id')->middleware('auth');
