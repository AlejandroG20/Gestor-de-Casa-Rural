<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estancia_habitacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estancia_id')->constrained('estancias')->onDelete('cascade'); // Relación con estancia
            $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade'); // Relación con habitación
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estancia_habitacion');
    }
};
