<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $habitaciones = [];

        // Crear 10 habitaciones tipo suite
        for ($i = 1; $i <= 10; $i++) {
            $habitaciones[] = [
                'numero' => $i,
                'tipo' => 'suite',
                'precio_noche' => 150.00,
                'disponible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Crear 20 habitaciones tipo doble
        for ($i = 11; $i <= 30; $i++) {
            $habitaciones[] = [
                'numero' => $i,
                'tipo' => 'doble',
                'precio_noche' => 100.00,
                'disponible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Crear 20 habitaciones tipo estándar
        for ($i = 31; $i <= 50; $i++) {
            $habitaciones[] = [
                'numero' => $i,
                'tipo' => 'estandar',
                'precio_noche' => 55.00,
                'disponible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertar todas las habitaciones en la base de datos
        DB::table('habitaciones')->insert($habitaciones);
    }
}
