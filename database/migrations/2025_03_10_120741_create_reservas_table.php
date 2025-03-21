<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Define la estructura de la tabla 'reservas'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); // ID autoincremental como clave primaria
            $table->foreignId('usuario_id')->constrained('usuario')->onDelete('cascade'); // Relación con la tabla 'users'
            $table->integer('dias')->default(0); // Cantidad de días de la reserva
            $table->date('fecha_salida');  // Fecha fin de la reserva
            $table->date('fecha_entrada');  // Fecha inicio de la reserva
            $table->decimal('precio_reserva', 15, 2); // Precio total de la reserva
            $table->boolean('en_estancia')->default(false);
            $table->timestamps(); // Registra las fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * Elimina la tabla 'reservas' si se revierte la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
};
