<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function verificar()
    {
        $user = Auth::user();

        if ($user) {
            $empresa = Empresa::where('user_id', $user->id)->first();

            return response()->json([
                'empresa' => $empresa,
                'message' => $empresa ? 'Tienes una entrada en la tabla empresas.' : 'No tienes una entrada en la tabla empresas.'
            ]);
        }

        return response()->json(['message' => 'No estás autenticado.'], 401);
    }

    public function crear(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $empresa = Empresa::create([
            'user_id' => $user->id,
            'nombre' => $request->nombre,
        ]);

        return response()->json(['empresa' => $empresa, 'message' => 'Empresa creada exitosamente.']);
    }
}
