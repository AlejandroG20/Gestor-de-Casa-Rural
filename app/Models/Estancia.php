<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    use HasFactory;

    protected $fillable = ['reserva_id', 'usuario_id', 'precio_final'];

    /**
     * Relación con reserva (muchos a uno)
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    /**
     * Relación con usuario (muchos a uno)
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Relación con servicios (muchos a muchos)
     */
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'estancia_servicio');
    }

    /**
     * Relación con habitaciones (muchos a muchos)
     */
    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'estancia_habitacion');
    }
}
