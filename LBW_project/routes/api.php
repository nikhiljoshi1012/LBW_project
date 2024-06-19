<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Define your API routes here
Route::middleware('auth:api')->get('/user-id', function (Request $request) {
    return $request->user()->id;
});

Route::middleware('auth:api')->get('/projects', 'App\Http\Controllers\ProjectController@projectList');

Route::get('/hello', function () {
    return response("Hello, World!");
});