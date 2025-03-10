<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    public function run()
    {
        // Reservas para el usuario 1
        $reserva1 = DB::table('reservas')->insertGetId([
            'usuario_id' => 1,  // Usuario 1
            'dias' => 3,
            'precio_reserva' => 120.00,  // Precio total (puedes calcularlo según los precios de las habitaciones)
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $reserva2 = DB::table('reservas')->insertGetId([
            'usuario_id' => 1,  // Usuario 1
            'dias' => 2,
            'precio_reserva' => 80.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Asociar habitaciones a la reserva del usuario 1
        DB::table('reserva_habitacion')->insert([
            ['reserva_id' => $reserva1, 'habitacion_id' => 1],  // Reserva 1 -> Habitación 1
            ['reserva_id' => $reserva1, 'habitacion_id' => 2],  // Reserva 1 -> Habitación 2
            ['reserva_id' => $reserva2, 'habitacion_id' => 3],  // Reserva 2 -> Habitación 3
        ]);

        // Asociar servicios a las reservas del usuario 1
        DB::table('reserva_servicio')->insert([
            ['reserva_id' => $reserva1, 'servicio_id' => 1],  // Reserva 1 -> Desayuno
            ['reserva_id' => $reserva1, 'servicio_id' => 3],  // Reserva 1 -> Limpieza Extra
            ['reserva_id' => $reserva2, 'servicio_id' => 2],  // Reserva 2 -> Spa
        ]);

        // Reservas para el usuario 3
        $reserva3 = DB::table('reservas')->insertGetId([
            'usuario_id' => 3,  // Usuario 3
            'dias' => 4,
            'precio_reserva' => 160.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $reserva4 = DB::table('reservas')->insertGetId([
            'usuario_id' => 3,  // Usuario 3
            'dias' => 5,
            'precio_reserva' => 200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Asociar habitaciones a las reservas del usuario 3
        DB::table('reserva_habitacion')->insert([
            ['reserva_id' => $reserva3, 'habitacion_id' => 4],  // Reserva 3 -> Habitación 4
            ['reserva_id' => $reserva3, 'habitacion_id' => 5],  // Reserva 3 -> Habitación 5
            ['reserva_id' => $reserva4, 'habitacion_id' => 6],  // Reserva 4 -> Habitación 6
        ]);

        // Asociar servicios a las reservas del usuario 3
        DB::table('reserva_servicio')->insert([
            ['reserva_id' => $reserva3, 'servicio_id' => 4],  // Reserva 3 -> Cama Adicional
            ['reserva_id' => $reserva3, 'servicio_id' => 5],  // Reserva 3 -> Traslado al Aeropuerto
            ['reserva_id' => $reserva4, 'servicio_id' => 6],  // Reserva 4 -> Cena
        ]);
    }
}
