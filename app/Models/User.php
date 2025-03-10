<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nombre',
        'email',
        'contraseña',
        'dni',
        'telefono',
        'is_admin',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

}
