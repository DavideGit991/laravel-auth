<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::post('/upload', 'ImageController@upload')
    ->name('upload');
Route::get('/delete/avatar', 'imageController@deleteDb')
    ->name('delete-avatar');
