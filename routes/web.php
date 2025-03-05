<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

Route::view('/', 'home.index')->name('index');
Route::view('home.habitaciones', 'home.habitaciones')->name('habitaciones');
Route::view('home.reservas', 'home.reservas')->name('reservas');
Route::view('rooms.estandar', 'rooms.estandar')->name('estandar');
Route::view('rooms.matrimonio', 'rooms.matrimonio')->name('matrimonio');
Route::view('rooms.suite', 'rooms.suite')->name('suite');
Route::view('home.casa', 'home.casa')->name('casa');
Route::view('auth.cuenta', 'auth.cuenta')->name('cuenta');
Route::view('auth.login', 'auth.login')->name('login');
Route::view('admin.admin', 'admin.admin')->name('admin');

// Iniciar Sesion Prueba
Route::get('/test-login', function () {
    // Iniciar sesión con el usuario cuyo ID es 1
    $user = User::find(1);  // Aquí buscas el usuario con ID 1
    if ($user) {
        Auth::login($user);  // Inicia sesión con ese usuario
        return redirect('/');  // Redirige a la página de prueba (o dashboard)
    }

    // Si no encuentra el usuario, puedes manejarlo aquí
    return 'Usuario no encontrado';
});

//Cerrar Sesion
Route::post('/logout', function (Request $request) {
    Auth::logout(); // Cierra la sesión del usuario
    $request->session()->invalidate(); // Invalida la sesión
    $request->session()->regenerateToken(); // Regenera el token CSRF

    return redirect('/'); // Redirige a la página de inicio
})->name('logout');
