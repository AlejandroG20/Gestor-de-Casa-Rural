<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estancia extends Model
{
    use HasFactory;

    protected $fillable = ['reserva_id', 'usuario_id', 'precio_final'];

   
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }


    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'estancia_servicio');
    }

   
    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'estancia_habitacion');
    }
}
