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

Route::get('/', 'PostController@index')->name('posts.index');
Route::get('/posts/{id}', 'PostController@show')->name('posts.show');
Route::post('/post/store', 'PostController@store')->name('posts.store')->middleware('auth');
Route::get('/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::post('/post/update/{id}', 'PostController@update')->name('posts.update')->middleware('auth');
Route::get('/edit/{id}', 'PostController@edit')->name('posts.edit')->middleware('auth');
Route::delete('/post/destroy/{id}', 'PostController@destroy')->name('posts.destroy')->middleware('auth');
Route::get('/delete/{id}', 'PostController@delete')->name('posts.delete')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
