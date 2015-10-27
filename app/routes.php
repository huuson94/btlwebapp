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
Route::post('update',array('user'=>'UsersController@DetailsUpdate','as'=>'Details.update'));
Route::controller('category', 'CategoriesController');
Route::controller('image', 'ImagesController');
Route::controller('album', 'AlbumsController');
Route::get('/','HomeController@getIndex');
Route::resource('admin', 'UsersController');
Route::resource('admin-category', 'CategoriesController');
Route::get('details','UsersController@getViewDetails');

