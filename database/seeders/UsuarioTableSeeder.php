<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioTableSeeder extends Seeder
{
    public function run()
    {
        // Insertar un usuario manualmente
        Usuario::create([
            'nombre' => 'User',
            'email' => 'user@example.com',
            'contraseña' => bcrypt('user123'), // Usando bcrypt para la contraseña
            'dni' => '12345678A',
            'telefono' => '600 600 601',
            'admin' => false,
        ]);

        Usuario::create([
            'nombre' => 'Admin',
            'email' => 'admin@example.com',
            'contraseña' => bcrypt('admin123'), // Usando bcrypt para la contraseña
            'dni' => '12345678B',
            'telefono' => '600 600 602',
            'admin' => true,
        ]);

    }
}
