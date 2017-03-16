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
    return redirect(route('movies.index'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::resource('groups', 'GroupController');
    Route::resource('tags', 'TagController');
    Route::resource('bookmarks', 'BookmarkController');
});

// auth middleware applied selectively in MovieController constructor
Route::name('movies.new')
    ->get('/movies/new', 'MovieController@new');
Route::name('movies.addnew')
    ->post('/movies/create', 'MovieController@create');
Route::name('movies.group')
    ->match(['put', 'patch'], '/movies/{movie}/group', 'MovieController@group');
Route::name('movies.genres')
     ->put('/movies/{movie}/genres', 'MovieController@genres');
Route::name('movies.tags')
    ->post('/movies/{movie}/tags', 'MovieController@tags');
Route::resource('movies', 'MovieController');

Route::resource('genres', 'GenreController');
