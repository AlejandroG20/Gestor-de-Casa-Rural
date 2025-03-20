<?php

namespace App\Http\Controllers;

use App\Models\Estancia;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstanciaController extends Controller
{
    /**
     * Muestra todas las estancias del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usuario = Auth::user();
        $estancias = Estancia::where('usuario_id', $usuario->id)
            ->with(['reservas', 'servicios', 'habitaciones'])
            ->get();

        return view('estancias.index', compact('estancias'));
    }

    /**
     * Crea una nueva estancia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'usuario_id' => 'required|exists:users,id',
            'precio_final' => 'required|numeric',
        ]);

        $estancia = Estancia::create($validatedData);

        // Relacionar servicios si los hay
        if ($request->has('servicios')) {
            $servicios = Servicio::find($request->servicios);
            $estancia->servicios()->sync($servicios);
        }

        // Relacionar habitaciones si las hay
        if ($request->has('habitaciones')) {
            $habitaciones = Habitacion::find($request->habitaciones);
            $estancia->habitaciones()->sync($habitaciones);
        }

        return response()->json(['message' => 'Estancia creada correctamente', 'estancia' => $estancia]);
    }

    /**
     * Muestra una estancia específica.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
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
