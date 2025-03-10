<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Esta función se ejecuta para crear la tabla 'habitaciones' en la base de datos.
     * Se define la estructura de la tabla con las columnas necesarias.
     *
     * @return void
     */
    public function up()
    {
        // Crea la tabla 'habitaciones' con las siguientes columnas
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' autoincremental como clave primaria
            $table->integer('numero'); // Crea la columna 'numero' para el número de habitación
            $table->string('tipo'); // Crea la columna 'tipo' para el tipo de habitación (por ejemplo, estándar, suite)
            $table->decimal('precio_noche', 10, 2); // Crea la columna 'precio_noche' para el precio por noche con 2 decimales
            $table->boolean('disponible')->default(true); // Crea columna 'disponible' para consultar la disponibilidad 
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * Esta función se ejecuta para eliminar la tabla 'habitaciones' en caso de revertir la migración.
     *
     * @return void
     */
    public function down()
    {
        // Elimina la tabla 'habitaciones' si existe
        Schema::dropIfExists('habitaciones');
    }
};
