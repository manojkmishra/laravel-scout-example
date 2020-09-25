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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/{provider}', 'Auth\socialacctController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\socialacctController@handleProviderCallback');


// Search Routes for Laravel Scout
Route::get('/posts/search', 'PostController@search')->name('posts.search');
Route::resource('/posts', 'PostController');


