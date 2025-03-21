<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ActualizarCuentaController extends Controller
{
    public function edit()
    {
        $user = Auth::usuario(); // Obtener los datos del usuario autenticado
        return view('auth.perfil', compact('user'));
    }

    public function showProfile()
    {
        $user = Auth::usuario(); // Obtener el usuario autenticado
        return view('auth.perfil', compact('user')); // Pasar la variable $user a la vista
    }


    public function update(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'dni' => 'required|string|max:15',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user = Auth::usuario();

        // Actualización de datos
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->dni = $request->dni;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Encriptación de la contraseña
        }

        $user->save();

        return redirect()->route('account.edit')->with('success', 'Datos actualizados correctamente');
    }
}
