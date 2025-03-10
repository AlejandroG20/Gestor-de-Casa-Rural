<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    /**
     * Listar todos los servicios
     */
    public function index()
    {
        return response()->json(Servicio::all());
    }

    /**
     * Crear un nuevo servicio
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:servicios,nombre',
            'precio' => 'required|numeric|min:0'
        ]);

        $servicio = Servicio::create($request->all());

        return response()->json([
            'message' => 'Servicio creado exitosamente',
            'servicio' => $servicio
        ]);
    }

    /**
     * Actualizar un servicio
     */
    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $request->validate([
            'nombre' => 'string|unique:servicios,nombre,' . $id,
            'precio' => 'numeric|min:0'
        ]);

        $servicio->update($request->all());

        return response()->json([
            'message' => 'Servicio actualizado',
            'servicio' => $servicio
        ]);
    }

    /**
     * Eliminar un servicio
     */
    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return response()->json(['message' => 'Servicio eliminado']);
    }
}
