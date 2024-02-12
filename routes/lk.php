<?php

use Illuminate\Support\Facades\Route;

Route::middleware("guest:lk")->group(function() {
    Route::get('login', [\App\Http\Controllers\LK\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login_process', [\App\Http\Controllers\LK\AuthController::class, 'login'])->name('login_process');
});

Route::middleware("auth:lk")->group(function () {
    Route::get('logout', [\App\Http\Controllers\LK\AuthController::class, 'logout'])->name('logout');

    Route::resource('users', \App\Http\Controllers\LK\UserController::class);
    Route::resource('comments', \App\Http\Controllers\LK\CommentController::class);
});
