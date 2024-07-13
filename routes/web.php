<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PdfController; 
use App\Http\Controllers\ProfileController;





//Custom auth routes
// Routes that do not require authentication
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});








Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
Route::post('updatepic', [ProfileController::class, 'updatepic'])->name('updatepic');
Route::post('updateinfo', [ProfileController::class, 'updateinfo'])->name('updateinfo');




Route::get('/landing', function () {
    return view('land');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('download-pdf/{id}', [App\Http\Controllers\PdfController::class, 'downloadPdf'])->name('download-pdf');

Route::get('/', function () {
    notify()->success('Welcome to Raaga Taal', 'Welcome');  
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
