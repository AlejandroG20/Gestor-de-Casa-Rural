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
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        $room_type = $request->input('room_type');

        $check_in_date = new \DateTime($check_in);
        $check_out_date = new \DateTime($check_out);

        $interval = $check_in_date->diff($check_out_date);
        $days = $interval->days;

        $prices = [
            'Suite' => 150,
            'Doble' => 100,
            'Estandar' => 55
        ];

        $price_per_night = $prices[$room_type] ?? 0;
        $total_price = $price_per_night * $days;

        return view('home.habitaciones', ['estimatedPrice' => $total_price]);
    }
}
