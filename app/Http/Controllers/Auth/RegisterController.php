<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:usuario,nombre',
            'email' => 'required|string|email|max:255|unique:usuario,email',
            'dni' => 'required|string|max:20|unique:usuario,dni',
            'telefono' => 'required|string|max:20|unique:usuario,telefono',
            'contraseña' => 'required|string|min:6|confirmed',
        ]);

        if ($validacion->fails()) {
            return redirect()->route('register')
                ->withErrors($validacion)
                ->withInput();
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'contraseña' => Hash::make($request->contraseña),
        ]);

        Auth::login($usuario);

        return redirect()->intended('/');
    }
}
