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

Route::post('login', 'SessionController@store');
Route::get('logout', 'SessionController@destroy');
Route::get('signup', 'UsersController@create');
Route::resource('user','UsersController');

Route::controller('home','HomeController');
Route::post('update',array('user'=>'UsersController@DetailsUpdate','as'=>'Details.update'));
Route::controller('category', 'CategoriesController');
Route::resource('image', 'ImagesController');
Route::resource('album', 'AlbumsController');
Route::get('/','HomeController@getIndex');
Route::controller('admin', 'AdminController');
Route::resource('admin-category', 'CategoriesController');
Route::resource('admin-album', 'AlbumsController');
Route::get('details','UsersController@getViewDetails');

