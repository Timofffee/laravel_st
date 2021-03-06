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

Route::get('/', 'UserController@all');

Auth::routes();

Route::get('/home', 'UserController@index')->name('home')->middleware('auth');

Route::get('/user/{id}', 'UserController@index')->name('user');

Route::get('/comment/all/{id}', 'CommentController@all');
Route::get('/all', 'CommentController@all');
Route::get('/comment/{id}', 'CommentController@showComment')->name('showComment');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('delete_comment')->middleware('auth');
Route::post('/comment/new_comment', 'CommentController@new')->name('new_comment')->middleware('auth');

Route::get('/api/comment/getComments', 'CommentController@apiGetComments');
