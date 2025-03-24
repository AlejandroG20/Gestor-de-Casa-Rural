<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('home.servicios', compact('servicios'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|unique:servicios,nombre',
            'precio' => 'required|numeric|min:0'
        ]);

        $servicio = Servicio::create($validatedData);

        return response()->json([
            'message' => 'Servicio creado exitosamente',
            'servicio' => $servicio
        ]);
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'string|unique:servicios,nombre,' . $id,
            'precio' => 'numeric|min:0'
        ]);

        $servicio->update($validatedData);

        return response()->json([
            'message' => 'Servicio actualizado exitosamente',
            'servicio' => $servicio
        ]);
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);

        $servicio->delete();

        return response()->json(['message' => 'Servicio eliminado exitosamente']);
    }
}
