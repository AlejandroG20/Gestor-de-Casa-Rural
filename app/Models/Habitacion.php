<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $fillable = [
        'tipo',
        'numero',
        'precio',
        'disponible',
        'casa_id',
        'domotica_id',
    ];

    /**
     * Relación con reservas.
     */
    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'habitacion_reserva');
    }
    
}
