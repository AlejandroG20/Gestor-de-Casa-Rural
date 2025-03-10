<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Usa el modelo Usuario en lugar de User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
            'nombre' => 'required|string|max:255|unique:usuarios,nombre', // Cambia la tabla a 'usuarios'
            'email' => 'required|string|email|max:255|unique:usuarios,email', // Cambia la tabla a 'usuarios'
            'dni' => 'required|string|max:20|unique:usuarios,dni', // Cambia la tabla a 'usuarios'
            'telefono' => 'required|string|max:20|unique:usuarios,telefono', // Cambia la tabla a 'usuarios'
            'contraseña' => 'required|string|min:6|confirmed', // Contraseña obligatoria, mínimo 6 caracteres y debe confirmarse
        ]);

        // Si la validación falla, redirige de vuelta con errores y datos ingresados
        if ($validacion->fails()) {
            return redirect()->route('register') // Redirige a la vista de registro
                ->withErrors($validacion) // Devuelve los errores de validación
                ->withInput(); // Mantiene los datos ingresados
        }

        // Crear un nuevo usuario y hashear la contraseña
        $usuario = Usuario::create([ // Usa el modelo Usuario
            'nombre' => $request->nombre, // Asigna el nombre ingresado
            'email' => $request->email, // Asigna el email ingresado
            'dni' => $request->dni, // Asigna el DNI ingresado
            'telefono' => $request->telefono, // Asigna el teléfono ingresado
            'contraseña' => Hash::make($request->contraseña), // Hashea la contraseña antes de guardarla
        ]);

        // Inicia sesión automáticamente con el nuevo usuario registrado
        Auth::login($usuario);

        // Redirige al usuario a la página principal o dashboard
        return redirect()->intended('/');
    }
}
