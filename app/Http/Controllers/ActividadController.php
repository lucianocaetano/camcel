<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function store(Request $request)
    {
        // Valida los datos entrantes
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'trabajo' => 'required|string',
            'fechas' => 'required|array',
            'fechas.*.fechaInicio' => 'required|date',
            'fechas.*.timeE' => 'required|string',
            'fechas.*.timeS' => 'required|string',
            'operadores' => 'required|array',
            'operadores.*.nombre' => 'required|string',
            'operadores.*.rol' => 'required|string',
            'documentos' => 'required|array',
            'documentos.*.titulo' => 'required|string',
            'documentos.*.url' => 'nullable|string',
            'documentos.*.dataTang' => 'nullable|date',
            'documentos.*.valido' => 'required|boolean',
        ]);

        // Aquí puedes procesar y almacenar los datos
        // Por ejemplo, guardando en una base de datos

        return response()->json([
            'message' => 'Actividad registrada exitosamente',
            'data' => $validatedData
        ], 201);
    }
}

