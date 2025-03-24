<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $table = 'habitaciones';  
    protected $fillable = ['numero', 'tipo', 'precio_noche', 'disponible'];

  
    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'reserva_habitacion');
    }

    public function ocupar()
    {
        $this->disponible = false;
        $this->save();
    }

 
    public function liberar()
    {
        $this->disponible = true;
        $this->save();
    }
}
