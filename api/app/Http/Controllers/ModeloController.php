<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;

class ModeloController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
    ]);

    Modelo::create([
        'nombre' => $request->nombre,
    ]);

    return response()->json(['success' => 'Modelo agregado correctamente']);
}

}
