<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiaryController;

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
Route::get('/dashboard', [DiaryController::class, 'index'])->middleware('auth')->name('dashboard');

// User
Route::resource('/users', UserController::class);
Route::post('/users/email/check', [UserController::class, 'emailCheck'])->name('email.check');

// Login / Logout
Route::group(['prefix' => '/auth'], function () {
    Route::get('', [AuthController::class, 'index'])->name('index');                                   // Login Form
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/diaries', [DiaryController::class, 'index'])->name('diary.index');                          // Diary List
    Route::post('/diaries', [DiaryController::class, 'store'])->name('diary.save');                         // Diary Save
    Route::delete('/diaries/{diaryId}', [DiaryController::class, 'destroy']);           // Diary Delete
    Route::patch('/diaries/{diaryId}', [DiaryController::class, 'update']);             // Diary Update
    Route::post('/diaries/image', [DiaryController::class, 'saveImage']);
});


Route::get('/test', function (\Illuminate\Http\Request $request) {
    $list = $request->input('list');
    if($request->input('list') == null) $list = [1, 2, 3, 4, 5];
    $a = [];
//    return view("test", ['a' => $a]);
    return view('test', ['list' => $list,]);
})->name('test');
Route::get('/test2', function () {
    return view("dashboard");
})->name('test2');
