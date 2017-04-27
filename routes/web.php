<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/threads', 'ThreadController@index');
Route::get('/threads/create', 'ThreadController@create')->name('createThread');
Route::get('/threads/{channel}', 'ThreadController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::post('/threads', 'ThreadController@store');

Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');

// Favorite routes
Route::post('/replies/{reply}/favorites', 'FavoritesController@store');