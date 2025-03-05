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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' autoincremental
            $table->string('nombre'); // Crea la columna 'nombre'
            $table->string('email')->unique(); // Crea la columna 'email' única
            $table->string('password'); // Crea la columna 'password'
            $table->string('dni')->unique(); // Crea la columna 'dni' única
            $table->string('telefono')->unique(); // Crea la columna 'telefono' única
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
