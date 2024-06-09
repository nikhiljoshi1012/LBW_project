<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/raaga_taal', function () {
    return view('raaga_taal');
});