<?php

use App\Http\Controllers\CuentaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/usuarios',[ UsuarioController::class,'index']);
Route::post('/usuarios-procesar-login-post',[ UsuarioController::class,'procesar'])->name('user.procesar');


Route::get('/cuentas',[ CuentaController::class,'index']);
Route::post('/cuenta-buscar-por-cuentas',[ CuentaController::class,'procesar'])->name('cuenta.procesar');