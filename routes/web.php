<?php

use App\Http\Controllers\CuentaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Mockery\Matcher\Not;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios-procesar-login-post', [UsuarioController::class, 'procesar'])->name('user.procesar');


Route::get('/cuentas', [CuentaController::class, 'index']);
Route::post('/cuenta-buscar-por-cuentas', [CuentaController::class, 'procesar'])->name('cuenta.procesar');

Route::get('/noticias', [NoticiaController::class, 'index'])->name('n.index');
Route::post('/guardar-comentario', [NoticiaController::class, 'guardar'])->name('n.guardar');

//rutas para el login
Route::get('login-demo', [LoginController::class, 'showLoginForm'])->name('login.demo.form');
Route::post('login-demo', [LoginController::class, 'login'])->name('login.demo.submit');

// Ruta de dashboard (protegida, solo accesible si estás logueado)
Route::get('dashboard-demo', function () {
    if (Auth::check()) { // Usar Auth::check()
        return redirect()->route('n.index'); // Redirigir a la ruta de noticias
    }
    return redirect()->route('login.demo.form')->with('error', 'Por favor, inicia sesión para acceder al dashboard.');
})->name('dashboard.demo');

// Ruta para logout
Route::post('logout-demo', [LoginController::class, 'logout'])->name('logout.demo');
