<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Mostrar formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Manejar el registro
    public function register(Request $request)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:users,nombre',
            'email' => 'required|string|email|max:255|unique:users,email',
            'dni' => 'required|string|max:20|unique:users,dni', // Validación para DNI
            'telefono' => 'required|string|max:20|unique:users,telefono', // Validación para Teléfono
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Si hay errores en la validación
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Crear un nuevo usuario sin hashear la contraseña
        $user = User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,  // Asegúrate de pasar el email
            'dni' => $request->dni,      // Pasar el DNI
            'telefono' => $request->telefono,  // Pasar el teléfono
            'password' => $request->password, // Almacena la contraseña sin hashear
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        // Redirigir al usuario al dashboard o página principal
        return redirect()->intended('/');
    }
}
