<?php

use App\Http\Controllers\CurrentAttemptController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\NotificationController;
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
    //quit-attempts
    Route::get('/current-attempt', [CurrentAttemptController::class, 'index'])->name('current-attempt');
    Route::put('/end-attempt/{attempt}', [CurrentAttemptController::class, 'endCurrentAttempt'])->name('current-attempt.end');

    //rewards
    Route::get('/rewards/{quit_attempt}', [RewardController::class, 'index'])->name('rewards');
    Route::post('/rewards/add', [RewardController::class, 'store'])->name('rewards.store');
    Route::get('/rewards', [RewardController::class, 'show'])->name('rewards');

    //notifications
    Route::get('/notification-settings', [NotificationController::class, 'index'])->name('notification-settings');
    Route::put('/notification-settings/update/{user}', [NotificationController::class, 'update'])->name('notification-settings.update');

    //resource routes
    Route::resource('quit-attempts', QuitAttemptController::class);
});
