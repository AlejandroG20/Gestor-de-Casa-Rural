<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuario'; 

    protected $fillable = [
        'nombre',
        'email',
        'contraseña',
        'dni',
        'telefono',
        'admin', 
    ];

    protected $hidden = [
        'contraseña', 
        'remember_token',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
