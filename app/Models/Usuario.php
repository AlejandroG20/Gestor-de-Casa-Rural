<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    // Definir el nombre de la tabla si es diferente
    protected $table = 'usuario'; // Asegúrate de que coincida con el nombre de la tabla en la base de datos

    // Los atributos que se pueden llenar de manera masiva
    protected $fillable = [
        'nombre',
        'email',
        'contraseña',
        'dni',
        'telefono',
        'admin', // Asegúrate de tener este campo en tu base de datos si planeas usarlo
    ];

    // Los atributos que deben ser ocultos cuando se convierten en un array o JSON
    protected $hidden = [
        'contraseña', // Es importante que el campo contraseña esté oculto
        'remember_token',
    ];

    // Asegúrate de que las contraseñas se hasheen automáticamente al crearlas o actualizarlas
    public static function boot()
    {
        parent::boot();

        static::saving(function ($usuario) {
            if ($usuario->isDirty('contraseña')) {
                $usuario->contraseña = bcrypt($usuario->contraseña);
            }
        });
    }
}
