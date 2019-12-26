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

Route::get('/user/configuration', 'UserController@config')->name('user.config');

Route::post('/user/update', 'UserController@update')->name('user.update');

Route::post('/user/updatePassword', 'UserController@updatePassword')->name('user.updatePassword');

Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
