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
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\EstanciaController;
use App\Http\Controllers\AdminController;

// Rutas de la página de inicio 
Route::view('/', 'home.index')->name('index');

//Rutas de habitaciones
Route::view('home.habitaciones', 'home.habitaciones')->name('habitaciones');
Route::view('rooms.estandar', 'rooms.estandar')->name('estandar');
Route::view('rooms.matrimonio', 'rooms.matrimonio')->name('matrimonio');
Route::view('rooms.suite', 'rooms.suite')->name('suite');

//Ruta info casa
Route::view('home.casa', 'home.casa')->name('casa');
Route::view('auth.register', 'auth.register')->name('register');
Route::get('home.servicios', [ServicioController::class, 'index'])->name('servicios');

// Ruta para mostrar todas las reservas del usuario
Route::get('auth.cuenta', [CuentaController::class, 'index'])->name('cuenta');
Route::view('auth.perfil', 'auth.perfil')->name('perfil');

// Ruta para crear una nueva reserva
Route::post('auth.cuenta', [CuentaController::class, 'store'])->middleware('auth')->name('reservas.store');

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

// Habitaciones
Route::get('/habitaciones', [PrecioEstimadoController::class, 'showForm']);
Route::post('/calculate-price', [PrecioEstimadoController::class, 'calculatePrice'])->name('calculate-price');

//Reservas
Route::get('home.reservas', [ReservaController::class, 'index'])->name('reservas');
Route::post('home.reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::delete('/reservas/{id}/cancelar', [ReservaController::class, 'cancel'])->name('reservas.cancelar');
Route::delete('/estancias/{id}/pagar', [EstanciaController::class, 'pagar'])->name('estancias.pagar');
Route::get('/informacion/reserva/{id}', [InformacionController::class, 'mostrarReserva'])->name('mas-info');
Route::get('/informacion/estancia/{id}', [InformacionController::class, 'mostrarEstancia'])->name('mas-info-estancia');

//Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/reserva/{id}', [AdminController::class, 'verDetallesReserva'])->name('admin.reservaDetalles');
