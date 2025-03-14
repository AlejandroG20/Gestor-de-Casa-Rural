<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'fecha_entrada',
        'fecha_salida',
        'precio_reserva',
        'dias'
    ];

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
     * Definir el mutador para formatear las fechas
     */
    public function getFechaEntradaAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getFechaSalidaAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $validatedData = $request->validate([
            'habitaciones' => 'required|array',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date',
        ]);

        // Crea una nueva reserva o estancia con el usuario autenticado
        $reserva = new Reserva();
        $reserva->usuario_id = Auth::id(); // Asigna el ID del usuario autenticado
        $reserva->fecha_entrada = $request->fecha_entrada;
        $reserva->fecha_salida = $request->fecha_salida;
        $reserva->save();

        // Asocia las habitaciones seleccionadas con la reserva
        $reserva->habitaciones()->attach($request->habitaciones);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada con éxito!');
    }
}
