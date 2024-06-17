<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ExamCenterController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobLocationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('admin')->group(function () {
    Route::post('add-location', [JobLocationController::class, 'store'])->name('location.store');
    Route::post('add-examCenter', [ExamCenterController::class, 'store'])->name('examCenter.store');
});
