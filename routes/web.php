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

/* Route::get('/', function () {
    return view('welcome');
})->name('welcome'); */

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


/* ROUTE USER */
Route::get('/user/configuration', 'UserController@config')->name('user.config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/user/updatePassword', 'UserController@updatePassword')->name('user.updatePassword');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');


/* ROUTE IMAGE */
Route::get('/image/create', 'ImageController@create')->name('image.create');
Route::post('/image/upload', 'ImageController@upload')->name('image.upload');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/image/{filename}', 'ImageController@detail')->name('image.detail');

/* ROUTE COMMMENT */
Route::post('/comment/newComment', 'CommentController@newComment')->name('comment.new');
Route::get('/comment/newComment/{comment_id}', 'CommentController@deleteComment')->name('comment.delete');

/* ROUTE LIKE */
Route::get('/like/{image_id}', 'LikeController@like')->name('like');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.dislike');