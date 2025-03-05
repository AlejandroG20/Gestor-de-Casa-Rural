<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'disponible',
        'estancia_id',
        'reserva_id',
    ];

    /**
     * Relación con estancias.
     */
    public function estancia()
    {
        return $this->belongsTo(Estancia::class);
    }

    /**
     * Relación con reservas.
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
