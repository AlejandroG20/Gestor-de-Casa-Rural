<?php

namespace App\Http\Controllers;

use App\Models\Reserva;

class AdminController extends Controller
{
    public function index()
    {
        $reservas_activas = Reserva::where('fecha_salida', '>=', now())->get();
        $reservas_pasadas = Reserva::where('fecha_salida', '<', now())->get();

        return view('admin.admin', compact('reservas_activas', 'reservas_pasadas'));
    }

    public function verDetallesReserva($id)
    {
        $reserva = Reserva::with('usuario')->findOrFail($id);

        return view('home.informacion_admin', compact('reserva'));
    }
}
