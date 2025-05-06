<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');