<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Si hay errores en la validación
        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Intentar encontrar al usuario por 'nombre'
        $user = \App\Models\User::where('nombre', $request->nombre)->first();

        // Verificar si el usuario existe y la contraseña coincide en texto plano
        if ($user && $user->password === $request->password) {
            // Iniciar sesión manualmente sin hashing
            Auth::login($user);
            return redirect()->intended('/');
        } else {
            // Si las credenciales son incorrectas, mostrar un error
            return redirect()->route('login')->withErrors(['error' => 'Las credenciales no son válidas.']);
        }
    }
}
