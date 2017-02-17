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

Route::name('home')->get('/home', 'HomeController@index');

Route::name('movies.new')->get('/movies/new', 'MovieController@new');
Route::name('movies.addnew')->post('/movies/create', 'MovieController@create');
Route::resource('movies', 'MovieController');