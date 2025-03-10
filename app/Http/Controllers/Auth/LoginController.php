<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login'); // Retorna la vista del formulario de login
    }

    // Maneja el proceso de inicio de sesión
    public function login(Request $request)
    {
        // Valida los datos del formulario
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255', // El campo 'nombre' es obligatorio y debe ser una cadena de máximo 255 caracteres
            'contraseña' => 'required|string|min:6', // El campo 'contraseña' es obligatorio y debe tener al menos 6 caracteres
        ]);

        // Si la validación falla, redirige de vuelta al formulario con los errores
        if ($validacion->fails()) {
            return redirect()->route('login') // Redirige a la ruta de login
                ->withErrors($validacion) // Devuelve los errores de validación
                ->withInput(); // Mantiene los datos ingresados por el usuario
        }

        // Busca un usuario en la base de datos por el campo 'nombre'
        $usuario = Usuario::where('nombre', $request->nombre)->first(); // Cambia a la tabla 'usuarios'

        // Verifica si el usuario existe y si la contraseña es correcta usando Hash::check()
        if ($usuario && Hash::check($request->contraseña, $usuario->contraseña)) {
            // Inicia sesión automáticamente con el usuario autenticado
            Auth::login($usuario);
            return redirect()->intended('/'); // Redirige al usuario a la página principal o a donde intentó acceder antes
        } else {
            // Si las credenciales son incorrectas, redirige al login con un mensaje de error
            return redirect()->route('login')->withErrors(['error' => 'Las credenciales no son válidas.']);
        }
    }
}
