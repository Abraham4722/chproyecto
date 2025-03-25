<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
    ]);

    Marca::create([
        'nombre' => $request->nombre,
    ]);

    return response()->json(['success' => 'Marca agregada correctamente']);
}

}
