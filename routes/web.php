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


//Posts
Route::get('/', 'PostController@index');
Route::get('CreatePost', 'PostController@create');
Route::post('savePost','PostController@save');
Route::get('detailPost/{id}', 'PostController@detail')->name('detail.post');

//users
Route::get('User', 'UserController@index');
Route::post('create', 'UserController@create');
Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout');

//Category
Route::get('managamentCategory','CategoryController@index');
Route::post('createCategory','CategoryController@create');

//comments
Route::post('createComment', 'CommentController@create');

//Search
Route::post('search', 'SearchController@index');






