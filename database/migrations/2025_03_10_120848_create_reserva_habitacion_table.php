<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Crea la tabla pivot 'reserva_habitacion' para manejar la relación muchos a muchos
     * entre 'reservas' y 'habitaciones'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_habitacion', function (Blueprint $table) {
            $table->id(); // ID autoincremental como clave primaria
            $table->foreignId('reserva_id')->constrained('reservas')->onDelete('cascade'); // Clave foránea a 'reservas'
            $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade'); // Clave foránea a 'habitaciones'
            $table->timestamps(); // Registra fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * Elimina la tabla 'reserva_habitacion' si se revierte la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_habitacion');
    }
};
