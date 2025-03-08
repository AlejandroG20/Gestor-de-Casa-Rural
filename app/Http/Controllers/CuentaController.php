<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class CuentaController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();
        
        // Obtener todas las reservas asociadas al usuario
        $reservas = $usuario->reservas->load('habitaciones');
        
        // Pasar las reservas a la vista
        return view('auth.cuenta', compact('reservas'));
    }
}
