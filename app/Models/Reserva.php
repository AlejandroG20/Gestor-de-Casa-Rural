<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'usuario_id',
        'fecha_inicio',
        'fecha_fin',
        'precio_total',
        'estado',
    ];

    /**
     * Relación con el usuario que hizo la reserva.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relación con las estancias asociadas a la reserva.
     */
    public function estancias()
    {
        return $this->hasMany(Estancia::class);
    }

    /**
     * Relación con habitaciones (muchos a muchos).
     */
    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'habitacion_reserva')
            ->withTimestamps(); // Guarda los tiempos de creación/actualización
    }

    /**
     * Relación con los servicios contratados en la reserva.
     */
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'reserva_servicio')
            ->withPivot('cantidad', 'precio') // Si hay datos adicionales en la relación
            ->withTimestamps();
    }
}
