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
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'contraseña' => 'required|string|min:6',
        ]);

        if ($validacion->fails()) {
            return redirect()->route('login')
                ->withErrors($validacion)
                ->withInput();
        }

        $usuario = Usuario::where('email', operator: $request->email)->first(); // Cambia a la tabla 'usuarios'

        if ($usuario && Hash::check($request->contraseña, $usuario->contraseña)) {
            Auth::login($usuario);
            return redirect()->intended('/');
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Las credenciales no son válidas.']);
        }
    }
}
