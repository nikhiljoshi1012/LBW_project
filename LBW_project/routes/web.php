<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/raaga_taal', function () {
    return view('raaga_taal');
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Auth::routes();
// Dashboard route
Route::get('/dashboard', [ProjectController::class, 'index'])->middleware('auth')->name('dashboard');

// Project routes
Route::resource('projects', ProjectController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
