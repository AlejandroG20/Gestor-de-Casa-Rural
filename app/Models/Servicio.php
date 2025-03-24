<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio'];

 
    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'reserva_servicio');
    }
}
