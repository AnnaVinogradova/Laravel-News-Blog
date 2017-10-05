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
Route::post('/post/store', 'PostController@store')->name('posts.store');
Route::get('/create', 'PostController@create')->name('posts.create');
Route::post('/post/update/{id}', 'PostController@update')->name('posts.update');
Route::get('/edit/{id}', 'PostController@edit')->name('posts.edit');
Route::delete('/post/destroy/{id}', 'PostController@destroy')->name('posts.destroy');
Route::get('/delete/{id}', 'PostController@delete')->name('posts.delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
