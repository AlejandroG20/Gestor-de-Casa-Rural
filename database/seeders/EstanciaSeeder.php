<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Reserva;

class EstanciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener la reserva con ID 3
        $reserva = Reserva::find(3);

        if ($reserva) {
            // Crear una estancia para esta reserva
            DB::table('estancias')->insert([
                'usuario_id' => $reserva->usuario_id, // Usar el usuario de la reserva
                'reserva_id' => $reserva->id, // Asignar el id de la reserva
                'precio_final' => $reserva->precio_reserva, // Usar el precio de la reserva
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            // Si no existe la reserva con id 3
            echo "No se encontró la reserva con ID 3.";
        }
    }
}
