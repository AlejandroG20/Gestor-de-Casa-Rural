<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Estancia;

class InformacionController extends Controller
{
    public function mostrarReserva($id)
    {
        try {
            $reserva = Reserva::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Reserva no encontrada.'], 404);
        }

        return view('home.informacion', compact('reserva'));
    }

    public function mostrarEstancia($id)
    {
        try {
            $estancia = Estancia::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Estancia no encontrada.'], 404);
        }

        return view('home.informacion_estancia', compact('estancia'));
    }
}
