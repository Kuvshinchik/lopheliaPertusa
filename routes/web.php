<?php


Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});
// И т.д. для всех страниц