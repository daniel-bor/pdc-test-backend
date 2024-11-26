<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geografia\Municipio;

class MunicipioController extends Controller
{
    /**
     * Listar todos los municipios.
     */
    public function index()
    {
        $municipios = Municipio::with('departamento')->get();
        return response()->json([
            'success' => true,
            'data' => $municipios
        ], 200);
    }

    /**
     * Crear un nuevo municipio.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $municipio = Municipio::create([
            'nombre' => $request->nombre,
            'departamento_id' => $request->departamento_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Municipio creado exitosamente.',
            'data' => $municipio
        ], 201);
    }

    /**
     * Mostrar detalles de un municipio específico.
     */
    public function show($id)
    {
        $municipio = Municipio::with('departamento')->find($id);

        if (!$municipio) {
            return response()->json([
                'success' => false,
                'message' => 'Municipio no encontrado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $municipio
        ], 200);
    }

    /**
     * Actualizar un municipio existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $municipio = Municipio::find($id);

        if (!$municipio) {
            return response()->json([
                'success' => false,
                'message' => 'Municipio no encontrado.'
            ], 404);
        }

        $municipio->update([
            'nombre' => $request->nombre,
            'departamento_id' => $request->departamento_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Municipio actualizado exitosamente.',
            'data' => $municipio
        ], 200);
    }

    /**
     * Eliminar un municipio.
     */
    public function destroy($id)
    {
        $municipio = Municipio::find($id);

        if (!$municipio) {
            return response()->json([
                'success' => false,
                'message' => 'Municipio no encontrado.'
            ], 404);
        }

        $municipio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Municipio eliminado exitosamente.'
        ], 200);
    }
}
