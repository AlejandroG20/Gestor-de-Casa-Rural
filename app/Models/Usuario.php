<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    // Los atributos que se pueden llenar de manera masiva
    protected $fillable = [
        'nombre',
        'email',
        'contraseña',
        'dni',
        'telefono',
        'is_admin', // Asegúrate de tener este campo en tu base de datos si planeas usarlo
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
