<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/user', function() { return view('user'); });
Route::post('/user', 'User@setUserName');

Route::get('/', function () { return view('chat'); })->middleware('auth.custom');

Route::post('/chat', 'Chat@newMessage')->middleware('auth.custom');