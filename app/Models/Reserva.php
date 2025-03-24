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

    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'reserva_habitacion');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'reserva_servicio');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function getDiasAttribute()
    {
        if ($this->fecha_entrada && $this->fecha_salida) {
            return Carbon::parse($this->fecha_entrada)->diffInDays(Carbon::parse($this->fecha_salida));
        }
        return 0;
    }


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
        $validatedData = $request->validate([
            'habitaciones' => 'required|array',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date',
        ]);

        $reserva = new Reserva();
        $reserva->usuario_id = Auth::id();
        $reserva->fecha_entrada = $request->fecha_entrada;
        $reserva->fecha_salida = $request->fecha_salida;
        $reserva->save();

        $reserva->habitaciones()->attach($request->habitaciones);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada con éxito!');
    }
}
