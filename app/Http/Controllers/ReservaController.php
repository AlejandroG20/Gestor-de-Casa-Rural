<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Servicio;

class ReservaController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        $servicios = Servicio::all();
        return view('home.reservas', compact('habitaciones', 'servicios'));
    }
}
