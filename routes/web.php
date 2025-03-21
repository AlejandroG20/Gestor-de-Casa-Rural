<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PrecioEstimadoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CuentaController;

// Rutas de la página de inicio 
Route::view('/', 'home.index')->name('index');

//Rutas de habitaciones
Route::view('home.habitaciones', 'home.habitaciones')->name('habitaciones');
Route::view('rooms.estandar', 'rooms.estandar')->name('estandar');
Route::view('rooms.matrimonio', 'rooms.matrimonio')->name('matrimonio');
Route::view('rooms.suite', 'rooms.suite')->name('suite');

//Ruta info casa
Route::view('home.casa', 'home.casa')->name('casa');
Route::view('admin.admin', 'admin.admin')->name('admin');
Route::view('auth.register', 'auth.register')->name('register');
Route::get('home.servicios', [ServicioController::class, 'index'])->name('servicios');

// Ruta para mostrar todas las reservas del usuario
Route::get('auth.cuenta', [CuentaController::class, 'index'])->name('cuenta');

// Ruta para crear una nueva reserva
Route::post('auth.cuenta', [CuentaController::class, 'store'])->middleware('auth')->name('reservas.store');

// Ruta para cancelar una reserva
Route::delete('auth.cuenta/{id}', [CuentaController::class, 'cancel'])->middleware('auth')->name('reservas.cancelar');

// Cerrar Sesión
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Registrarse
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta de Login 
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('/habitaciones', [PrecioEstimadoController::class, 'showForm']);
Route::post('/calculate-price', [PrecioEstimadoController::class, 'calculatePrice'])->name('calculate-price');

//Reservas
Route::get('home.reservas', [ReservaController::class, 'index'])->name('reservas');
Route::post('home.reservas', [ReservaController::class, 'store'])->name('reservas.store');
