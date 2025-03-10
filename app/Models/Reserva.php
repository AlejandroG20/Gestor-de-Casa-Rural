<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'dias', 'precio_reserva'];

    /**
     * Relación con habitaciones (muchos a muchos)
     */
    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'reserva_habitacion');
    }

    /**
     * Evento que calcula automáticamente el precio_reserva antes de guardar
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($reserva) {
            $total = 0;

            foreach ($reserva->habitaciones as $habitacion) {
                $total += $habitacion->precio_noche * $reserva->dias;
            }

            $reserva->precio_reserva = $total;
        });
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'reserva_servicio');
    }

    public function calcularPrecioReserva()
    {
        $total = 0;

        foreach ($this->habitaciones as $habitacion) {
            $total += $habitacion->precio_noche * $this->dias;
        }

        $this->update(['precio_reserva' => $total]);
    }
}
