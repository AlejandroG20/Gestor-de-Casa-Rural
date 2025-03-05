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

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt(['nombre' => $request->username, 'password' => $request->password])) {
            // Redirigir al usuario a la página principal o al dashboard
            return redirect()->intended('/');
        } else {
            // Si las credenciales son incorrectas, mostrar un error
            return redirect()->route('login')->withErrors(['error' => 'Las credenciales no son válidas.']);
        }
    }
}
