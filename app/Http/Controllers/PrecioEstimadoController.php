<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrecioEstimadoController extends Controller
{
    public function showForm()
    {
        return view('habitaciones');
    }

    public function calculatePrice(Request $request)
    {
        // Obtener las fechas de entrada y salida
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        $room_type = $request->input('room_type');

        // Convertir las fechas a objetos DateTime
        $check_in_date = new \DateTime($check_in);
        $check_out_date = new \DateTime($check_out);

        // Calcular la diferencia entre las fechas en días
        $interval = $check_in_date->diff($check_out_date);
        $days = $interval->days;

        // Precios por noche
        $prices = [
            'Suite' => 150,
            'Doble' => 100,
            'Estandar' => 55
        ];

        // Obtener el precio por noche según el tipo de habitación
        $price_per_night = $prices[$room_type] ?? 0;

        // Calcular el precio total
        $total_price = $price_per_night * $days;

        // Pasar el precio estimado a la vista
        return view('home.habitaciones', ['estimatedPrice' => $total_price]);
    }
}
