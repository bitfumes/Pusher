<?php


Route::view('/', 'home');

Route::get('/login', function () {
    return view('home');
});
Route::get('{any}/{any1?}/{any2?}', function () {
    return view('home');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
