<?php

namespace App\Http\Controllers;

use App\Models\Estancia;
use App\Models\Reserva;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener reservas activas y pasadas
        $reservas_activas = Reserva::where('fecha_salida', '>=', now())->get();
        $reservas_pasadas = Reserva::where('fecha_salida', '<', now())->get();

        return view('admin.admin', compact('reservas_activas', 'reservas_pasadas'));
    }

    public function verDetallesReserva($id)
    {
        // Obtener la reserva específica junto con los detalles de usuario
        $reserva = Reserva::with('usuario')->findOrFail($id);

        return view('home.informacion_admin', compact('reserva'));
    }
}
