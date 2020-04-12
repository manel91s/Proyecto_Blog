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
Route::get('managamentPost', 'PostController@managament');
Route::get('editPost/{id}', 'PostController@edit');
Route::post('queryPost', 'Postcontroller@queryPost');
Route::post('deletePosts', 'Postcontroller@deletePost');
Route::post('savePost','PostController@save');
Route::get('detailPost/{id}', 'PostController@detail')->name('detail.post');


//users
Route::get('User/{id?}', 'UserController@index')->name('update.user');
Route::post('update', 'UserController@update');
Route::post('create', 'UserController@create');
Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout');

//Category
Route::get('managamentCategory','CategoryController@index');
Route::post('createCategory','CategoryController@create');
Route::get('detailCategory/{id}', 'CategoryController@detail')->name('detail.category');

//comments
Route::post('createComment', 'CommentController@create');

//Search
Route::post('search', 'SearchController@index');






