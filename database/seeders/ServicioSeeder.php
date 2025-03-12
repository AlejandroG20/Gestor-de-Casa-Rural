<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    public function run()
    {
        DB::table('servicios')->insert([
            [
                'nombre' => 'Desayuno',
                'precio' => 10.00,
            ],
            [
                'nombre' => 'Visita Guiada',
                'precio' => 50.00,
            ],
            [
                'nombre' => 'Limpieza Extra',
                'precio' => 15.00,
            ],
            [
                'nombre' => 'Cama Adicional',
                'precio' => 20.00,
            ],
            [
                'nombre' => 'Cena',
                'precio' => 25.00,
            ],
            [
                'nombre' => 'Comida',
                'precio' => 25.00,
            ],
            [
                'nombre' => 'piscina',
                'precio' => 25.00,
            ],
        ]);
    }
}
