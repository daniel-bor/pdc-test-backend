<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geografia\Departamento;

class DepartamentoController extends Controller
{
    /**
     * Listar todos los departamentos.
     */
    public function index()
    {
        $departamentos = Departamento::with('pais')->get();
        return response()->json([
            'success' => true,
            'data' => $departamentos
        ], 200);
    }

    /**
     * Crear un nuevo departamento.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:departamentos,nombre',
            'pais_id' => 'required|exists:pais,id'
        ]);

        $departamento = Departamento::create([
            'nombre' => $request->nombre,
            'pais_id' => $request->pais_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Departamento creado exitosamente.',
            'data' => $departamento
        ], 201);
    }

    /**
     * Mostrar los detalles de un departamento específico.
     */
    public function show($id)
    {
        $departamento = Departamento::with('pais')->find($id);

        if (!$departamento) {
            return response()->json([
                'success' => false,
                'message' => 'Departamento no encontrado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $departamento
        ], 200);
    }

    /**
     * Actualizar un departamento existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:departamentos,nombre,' . $id,
            'pais_id' => 'required|exists:pais,id'
        ]);

        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json([
                'success' => false,
                'message' => 'Departamento no encontrado.'
            ], 404);
        }

        $departamento->update([
            'nombre' => $request->nombre,
            'pais_id' => $request->pais_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Departamento actualizado exitosamente.',
            'data' => $departamento
        ], 200);
    }

    /**
     * Eliminar un departamento.
     */
    public function destroy($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json([
                'success' => false,
                'message' => 'Departamento no encontrado.'
            ], 404);
        }

        $departamento->delete();

        return response()->json([
            'success' => true,
            'message' => 'Departamento eliminado exitosamente.'
        ], 200);
    }
}
