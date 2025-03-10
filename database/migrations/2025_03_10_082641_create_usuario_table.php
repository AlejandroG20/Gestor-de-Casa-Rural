<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla 'usuario' con los campos necesarios
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->string('nombre'); // Nombre del usuario
            $table->string('email')->unique(); // Email único
            $table->string('contraseña'); // Contraseña
            $table->string('dni')->unique(); // DNI único
            $table->string('telefono')->unique(); // Teléfono único
            $table->boolean('admin')->default(false); // Si es admin o no
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    // Elimina la tabla 'usuario'
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
};
