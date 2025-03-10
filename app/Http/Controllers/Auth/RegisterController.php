<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Muestra el formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register'); // Retorna la vista del formulario de registro
    }

    // Maneja el proceso de registro de un nuevo usuario
    public function register(Request $request)
    {
        // Valida los datos ingresados en el formulario
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:users,nombre', // El nombre es obligatorio, de tipo string, máx. 255 caracteres y único en la tabla users
            'email' => 'required|string|email|max:255|unique:users,email', // El email es obligatorio, debe ser un email válido y único en users
            'dni' => 'required|string|max:20|unique:users,dni', // DNI obligatorio, tipo string, máx. 20 caracteres y único
            'telefono' => 'required|string|max:20|unique:users,telefono', // Teléfono obligatorio, tipo string, máx. 20 caracteres y único
            'contraseña' => 'required|string|min:6|confirmed', // Contraseña obligatoria, mínimo 6 caracteres y debe confirmarse
        ]);

        // Si la validación falla, redirige de vuelta con errores y datos ingresados
        if ($validacion->fails()) {
            return redirect()->route('register') // Redirige a la vista de registro
                ->withErrors(provider: $validacion) // Devuelve los errores de validación
                ->withInput(); // Mantiene los datos ingresados
        }

        // Crear un nuevo usuario sin hashear la contraseña (esto no es seguro y debe corregirse)
        $user = User::create([
            'nombre' => $request->nombre, // Asigna el nombre ingresado
            'email' => $request->email, // Asigna el email ingresado
            'dni' => $request->dni, // Asigna el DNI ingresado
            'telefono' => $request->telefono, // Asigna el teléfono ingresado
            'contraseña' => $request->contraseña, // Almacena la contraseña sin encriptar (no recomendado)
        ]);

        // Inicia sesión automáticamente con el nuevo usuario registrado
        Auth::login($user);

        // Redirige al usuario a la página principal o dashboard
        return redirect()->intended('/');
    }
}
