<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Home
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth');

// User
Route::resource('/users', UserController::class);
Route::post('/users/email/check', [UserController::class, 'emailCheck'])->name('email.check');


Route::group(['prefix' => '/auth'], function () {
    Route::get('', [AuthController::class, 'index']);           // Login Form
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});