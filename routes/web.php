<?php

use App\Http\Controllers\CuentaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Mockery\Matcher\Not;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/usuarios',[ UsuarioController::class,'index']);
Route::post('/usuarios-procesar-login-post',[ UsuarioController::class,'procesar'])->name('user.procesar');


Route::get('/cuentas',[ CuentaController::class,'index']);
Route::post('/cuenta-buscar-por-cuentas',[ CuentaController::class,'procesar'])->name('cuenta.procesar');

Route::get('/noticias', [NoticiaController::class, 'index'])->name('n.index');
Route::post('/guardar-comentario', [NoticiaController::class, 'guardar'])->name('n.guardar');