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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::resource('/posts', 'PostController', ['except' => 'create']);
Route::get('/posts/{post}/create', 'PostController@create')->name('posts.create');
Route::post('/posts/{post}/likes', 'LikesController@store')->name('likes.store');
Route::post('/posts/{post}/likes/{like}', 'LikesController@destroy')->name('likes.destroy');
