<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::post('/users', [\App\Http\Controllers\UserController::class, 'create']);

Route::resource('/users', UserController::class);
Route::post('/users/email/check', [UserController::class, 'emailCheck'])->name('email.check');

Route::group(['prefix' => '/auth'], function () {
    // Login Form
    Route::get('', [AuthController::class, 'index']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
