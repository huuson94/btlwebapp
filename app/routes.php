<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', 'UsersController@getLogin');
Route::get('signup', 'UsersController@getSignup');
Route::controller('home','HomeController');
Route::controller('user','UsersController');
Route::controller('category', 'CategoriesController');
Route::controller('image', 'ImagesController');
Route::controller('album', 'AlbumsController');
Route::get('/','HomeController@getIndex');
