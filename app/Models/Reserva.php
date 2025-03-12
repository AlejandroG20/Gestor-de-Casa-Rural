<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'fecha_entrada', 'fecha_salida', 'precio_reserva'];

    protected $appends = ['dias'];

    /**
     * Relación con habitaciones (muchos a muchos)
     */
    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'reserva_habitacion');
    }

    /**
     * Relación con servicios (muchos a muchos)
     */
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'reserva_servicio');
    }

    /**
     * Relación con usuario (muchos a uno)
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Accesor para calcular los días de la reserva
     */
    public function getDiasAttribute()
    {
        if ($this->fecha_entrada && $this->fecha_salida) {
            return Carbon::parse($this->fecha_entrada)->diffInDays(Carbon::parse($this->fecha_salida));
        }
        return 0;
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
                $total += $habitacion->precio_noche * $reserva->dias; // Usamos el accesor getDiasAttribute()
            }

            $reserva->precio_reserva = $total;
        });
    }

    /**
     * Método para recalcular y actualizar el precio de la reserva
     */
    public function calcularPrecioReserva()
    {
        $total = 0;

        foreach ($this->habitaciones as $habitacion) {
            $total += $habitacion->precio_noche * $this->dias;
        }

        $this->update(['precio_reserva' => $total]);
    }
}
