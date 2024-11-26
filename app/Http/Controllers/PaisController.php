<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geografia\Pais;

class PaisController extends Controller
{
    /**
     * Listar todos los países.
     */
    public function index()
    {
        $paises = Pais::all();
        return response()->json([
            'success' => true,
            'data' => $paises
        ], 200);
    }

    /**
     * Crear un nuevo país.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:pais,nombre',
        ]);

        $pais = Pais::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'País creado exitosamente.',
            'data' => $pais
        ], 201);
    }

    /**
     * Mostrar detalles de un país específico.
     */
    public function show($id)
    {
        $pais = Pais::find($id);

        if (!$pais) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pais
        ], 200);
    }

    /**
     * Actualizar un país existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:pais,nombre,' . $id,
        ]);

        $pais = Pais::find($id);

        if (!$pais) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado.'
            ], 404);
        }

        $pais->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'País actualizado exitosamente.',
            'data' => $pais
        ], 200);
    }

    /**
     * Eliminar un país.
     */
    public function destroy($id)
    {
        $pais = Pais::find($id);

        if (!$pais) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado.'
            ], 404);
        }

        $pais->delete();

        return response()->json([
            'success' => true,
            'message' => 'País eliminado exitosamente.'
        ], 200);
    }
}
