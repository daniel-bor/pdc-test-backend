<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    /**
     * Listar todos los colaboradores.
     */
    public function index()
    {
        $colaboradores = Colaborador::with('empresas')->get();
        return response()->json([
            'success' => true,
            'data' => $colaboradores
        ], 200);
    }

    /**
     * Crear un nuevo colaborador.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'correo' => 'required|email|unique:colaboradores,correo',
            'empresa_ids' => 'array', // IDs de las empresas asociadas (opcional)
            'empresa_ids.*' => 'exists:empresas,id',
        ]);

        $colaborador = Colaborador::create([
            'nombre' => $request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'correo' => $request->correo,
        ]);

        if ($request->has('empresa_ids')) {
            $colaborador->empresas()->attach($request->empresa_ids);
        }

        return response()->json([
            'success' => true,
            'message' => 'Colaborador creado exitosamente.',
            'data' => $colaborador->load('empresas')
        ], 201);
    }

    /**
     * Mostrar detalles de un colaborador específico.
     */
    public function show($id)
    {
        $colaborador = Colaborador::with('empresas')->find($id);

        if (!$colaborador) {
            return response()->json([
                'success' => false,
                'message' => 'Colaborador no encontrado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $colaborador
        ], 200);
    }

    /**
     * Actualizar un colaborador existente.
     */
    public function update(Request $request, $id)
    {
        $colaborador = Colaborador::find($id);

        if (!$colaborador) {
            return response()->json([
                'success' => false,
                'message' => 'Colaborador no encontrado.'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'correo' => 'required|email',
            'empresa_ids' => 'array', // IDs de las empresas asociadas (opcional)
            'empresa_ids.*' => 'exists:empresas,id',
        ]);

        $colaborador->update($request->only('nombre', 'fecha_nacimiento', 'telefono', 'correo'));

        if ($request->has('empresa_ids')) {
            $colaborador->empresas()->sync($request->empresa_ids);
        }

        return response()->json([
            'success' => true,
            'message' => 'Colaborador actualizado exitosamente.',
            'data' => $colaborador->load('empresas')
        ], 200);
    }

    /**
     * Eliminar un colaborador.
     */
    public function destroy($id)
    {
        $colaborador = Colaborador::find($id);

        if (!$colaborador) {
            return response()->json([
                'success' => false,
                'message' => 'Colaborador no encontrado.'
            ], 404);
        }

        $colaborador->empresas()->detach();
        $colaborador->delete();

        return response()->json([
            'success' => true,
            'message' => 'Colaborador eliminado exitosamente.'
        ], 200);
    }
}
