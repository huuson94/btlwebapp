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
Route::get('home','AlbumsController@index');
Route::get('/','AlbumsController@index');

Route::post('login', 'SessionController@store');
Route::get('logout', 'SessionController@destroy');
Route::get('signup', 'UsersController@create');
Route::resource('user','UsersController');

Route::resource('post','PostsController');
Route::resource('image', 'ImagesController');
Route::resource('album', 'AlbumsController');

Route::resource('comment','CommentsController');

Route::post('update',array('user'=>'UsersController@DetailsUpdate','as'=>'Details.update'));
Route::controller('category', 'CategoriesController');
Route::resource('image', 'ImagesController');
Route::resource('album', 'AlbumsController');

Route::group(array('prefix' => 'admin', 'before' => 'checkAdmin'), function(){
    Route::get('/','BEUsersController@index');
	Route::resource('user', 'BEUsersController');
	Route::resource('category', 'BECategoriesController');
    Route::resource('image', 'BEImageController');
});
