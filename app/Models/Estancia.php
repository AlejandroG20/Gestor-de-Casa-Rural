<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    use HasFactory;

    protected $table = 'estancias';

    protected $fillable = [
        'reserva_id',
        'casa_id',
        'fecha_entrada',
        'fecha_salida',
        'precio_total',
    ];

    /**
     * Relación con la reserva a la que pertenece la estancia.
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    /**
     * Relación con los servicios contratados en la estancia.
     */
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'estancia_servicio');
    }
}
