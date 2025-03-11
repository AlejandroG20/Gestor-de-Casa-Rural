<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    /**
     * Listar todos los servicios disponibles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Obtener todos los servicios y devolverlos en formato JSON
        return response()->json(Servicio::all());
    }

    /**
     * Crear un nuevo servicio.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'nombre' => 'required|string|unique:servicios,nombre',
            'precio' => 'required|numeric|min:0'
        ]);

        // Crear el nuevo servicio con los datos validados
        $servicio = Servicio::create($validatedData);

        // Retornar respuesta JSON con éxito
        return response()->json([
            'message' => 'Servicio creado exitosamente',
            'servicio' => $servicio
        ]);
    }

    /**
     * Actualizar un servicio existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Buscar el servicio por ID o lanzar error 404 si no existe
        $servicio = Servicio::findOrFail($id);

        // Validar los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'nombre' => 'string|unique:servicios,nombre,' . $id,
            'precio' => 'numeric|min:0'
        ]);

        // Actualizar el servicio con los datos validados
        $servicio->update($validatedData);

        // Retornar respuesta JSON con éxito
        return response()->json([
            'message' => 'Servicio actualizado exitosamente',
            'servicio' => $servicio
        ]);
    }

    /**
     * Eliminar un servicio existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Buscar el servicio por ID o lanzar error 404 si no existe
        $servicio = Servicio::findOrFail($id);

        // Eliminar el servicio
        $servicio->delete();

        // Retornar respuesta JSON con éxito
        return response()->json(['message' => 'Servicio eliminado exitosamente']);
    }
}
