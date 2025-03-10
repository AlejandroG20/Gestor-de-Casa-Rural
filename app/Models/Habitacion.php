<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $table = 'habitaciones';  // Especifica el nombre correcto de la tabla
    protected $fillable = ['numero', 'tipo', 'precio_noche', 'disponible'];

    /**
     * Relación con reservas (muchos a muchos)
     */
    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'reserva_habitacion');
    }

    /**
     * Marcar la habitación como ocupada (no disponible)
     */
    public function ocupar()
    {
        $this->disponible = false;
        $this->save();
    }

    /**
     * Marcar la habitación como disponible
     */
    public function liberar()
    {
        $this->disponible = true;
        $this->save();
    }
}
