<?php

namespace App\Http\Controllers;

use App\Models\Estancia;
use App\Models\Servicio;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstanciaController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $estancias = Estancia::where('usuario_id', $usuario->id)
            ->with(['reservas', 'servicios', 'habitaciones'])
            ->get();

        return view('estancias.index', compact('estancias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'usuario_id' => 'required|exists:users,id',
            'precio_final' => 'required|numeric',
        ]);

        $estancia = Estancia::create($validatedData);

        if ($request->has('servicios')) {
            $servicios = Servicio::find($request->servicios);
            $estancia->servicios()->sync($servicios);
        }

        if ($request->has('habitaciones')) {
            $habitaciones = Habitacion::find($request->habitaciones);
            $estancia->habitaciones()->sync($habitaciones);
        }

        return response()->json(['message' => 'Estancia creada correctamente', 'estancia' => $estancia]);
    }

    public function show($id)
    {
        $estancia = Estancia::with(['reservas', 'servicios', 'habitaciones'])->findOrFail($id);

        return view('estancias.show', compact('estancia'));
    }

    public function pagar($id)
    {
        $estancia = Estancia::findOrFail($id);

        if ($estancia->usuario_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para pagar esta estancia.');
        }

        $estancia->delete();

        return redirect()->route('cuenta')->with('message', 'Estancia pagada exitosamente');
    }
}
