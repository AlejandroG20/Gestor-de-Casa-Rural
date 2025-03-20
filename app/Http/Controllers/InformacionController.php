<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Estancia;
use Illuminate\Http\Request;

class InformacionController extends Controller
{

    public function mostrarReserva($id)
    {
        // Intenta encontrar la reserva por su ID
        try {
            $reserva = Reserva::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si no se encuentra, devuelve un error 404
            return response()->json(['message' => 'Reserva no encontrada.'], 404);
        }

        // Retorna la vista con los detalles de la reserva
        return view('home.informacion', compact('reserva'));
    }

    public function mostrarEstancia($id)
    {
        // Intenta encontrar la reserva por su ID
        try {
            $estancia = Estancia::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si no se encuentra, devuelve un error 404
            return response()->json(['message' => 'Estancia no encontrada.'], 404);
        }

        // Retorna la vista con los detalles de la reserva
        return view('home.informacion_estancia', compact('estancia'));
    }
}
