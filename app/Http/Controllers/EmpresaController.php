<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Listar todas las empresas.
     */
    public function index()
    {
        $empresas = Empresa::with(['pais', 'departamento', 'municipio', 'colaboradores'])->get();

        return response()->json([
            'success' => true,
            'data' => $empresas
        ], 200);
    }

    /**
     * Crear una nueva empresa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pais_id' => 'required|exists:pais,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'nit' => 'required|string|max:20|unique:empresas,nit',
            'razon_social' => 'required|string|max:255',
            'nombre_comercial' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|email|unique:empresas,correo',
        ]);

        $empresa = Empresa::create([
            'pais_id' => $request->pais_id,
            'departamento_id' => $request->departamento_id,
            'municipio_id' => $request->municipio_id,
            'nit' => $request->nit,
            'razon_social' => $request->razon_social,
            'nombre_comercial' => $request->nombre_comercial,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Empresa creada exitosamente.',
            'data' => $empresa
        ], 201);
    }

    /**
     * Mostrar detalles de una empresa específica.
     */
    public function show($id)
    {
        $empresa = Empresa::with(['pais', 'departamento', 'municipio', 'colaboradores'])->find($id);

        if (!$empresa) {
            return response()->json([
                'success' => false,
                'message' => 'Empresa no encontrada.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $empresa
        ], 200);
    }

    /**
     * Actualizar una empresa existente.
     */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json([
                'success' => false,
                'message' => 'Empresa no encontrada.'
            ], 404);
        }

        $request->validate([
            'pais_id' => 'exists:pais,id',
            'departamento_id' => 'exists:departamentos,id',
            'municipio_id' => 'exists:municipios,id',
            'nit' => 'string|max:20|unique:empresas,nit,' . $id,
            'razon_social' => 'string|max:255',
            'nombre_comercial' => 'string|max:255',
            'telefono' => 'string|max:15',
            'correo' => 'email|unique:empresas,correo,' . $id,
        ]);

        $empresa->update($request->only([
            'pais_id',
            'departamento_id',
            'municipio_id',
            'nit',
            'razon_social',
            'nombre_comercial',
            'telefono',
            'correo',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Empresa actualizada exitosamente.',
            'data' => $empresa->load(['pais', 'departamento', 'municipio', 'colaboradores'])
        ], 200);
    }

    /**
     * Eliminar una empresa.
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json([
                'success' => false,
                'message' => 'Empresa no encontrada.'
            ], 404);
        }

        $empresa->colaboradores()->detach();
        $empresa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Empresa eliminada exitosamente.'
        ], 200);
    }
}
