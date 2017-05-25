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


//Route::post('/adduser', 'milestone1@adduser');
Route::post('/adduser', 'authcontroller@adduser');
Route::post('/login', 'authcontroller@login');
Route::post('/logout', 'authcontroller@logout');
Route::post('/verify', 'authcontroller@verify');
Route::post('/additem', 'milestone1@additem');

Route::get('/item/{id}', 'milestone1@item');


Route::post('/search', 'milestone1@search');


//m2
Route::delete('/item/{id}', 'milestone1@delete_item');
Route::post('/follow', 'milestone1@follow');
Route::get('/user/{username}', 'milestone1@get_user');
Route::get('/user/{username}/following', 'milestone1@get_user_following');
Route::get('/user/{username}/followers', 'milestone1@get_user_follower');
//m3
Route::post('/item/{id}/like', 'milestone1@like');
Route::post('/addmedia', 'milestone1@addmedia');
Route::get('/media/{id}', 'milestone1@media');

Route::get('/', function () {
    return view('home');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/signin', function () {
    return view('signin');
});
