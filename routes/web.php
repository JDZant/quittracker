<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuitAttemptController;
use App\Http\Controllers\ReasonController;
use App\Models\QuitAttempt;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //resource routes
    Route::resource('quit-attempts', QuitAttemptController::class);
    Route::resource('reasons', ReasonController::class);
});
