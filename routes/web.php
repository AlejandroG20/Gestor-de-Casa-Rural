<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Rutas de la página de inicio y otras vistas
Route::view('/', 'home.index')->name('index');
Route::view('home.habitaciones', 'home.habitaciones')->name('habitaciones');
Route::view('home.reservas', 'home.reservas')->name('reservas');
Route::view('rooms.estandar', 'rooms.estandar')->name('estandar');
Route::view('rooms.matrimonio', 'rooms.matrimonio')->name('matrimonio');
Route::view('rooms.suite', 'rooms.suite')->name('suite');
Route::view('home.casa', 'home.casa')->name('casa');
Route::view('auth.cuenta', 'auth.cuenta')->name('cuenta');
Route::view('admin.admin', 'admin.admin')->name('admin');
Route::view('auth.register', 'auth.register')->name('register');

// Ruta de Login (usando el controlador)
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Cerrar Sesión
Route::post('/logout', function (Request $request) {
    Auth::logout(); // Cierra la sesión del usuario
    $request->session()->invalidate(); // Invalida la sesión
    $request->session()->regenerateToken(); // Regenera el token CSRF

    return redirect('/'); // Redirige a la página de inicio
})->name('logout');
