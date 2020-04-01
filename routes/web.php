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

Route::get('/', 'PostController@index');

//users
Route::get('User', 'UserController@index');
Route::post('create', 'UserController@create');
Route::post('login', 'UserController@login');



Route::get('Detalle', 'EntradaController@detalle');

