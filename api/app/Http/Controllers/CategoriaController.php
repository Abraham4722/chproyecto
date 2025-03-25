<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Color;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = [
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
            'modelos' => Modelo::with('marca')->get(),
            'tallas' => Talla::all(),
            'colores' => Color::all(),
        ];
    
        return view('admin.categorias', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
    ]);

    Categoria::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
    ]);

    return response()->json(['success' => 'Categoría agregada correctamente']);
}

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
{
    return view('admin.categorias.edit', compact('categoria'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        if ($categoria->productos()->count() > 0) {
            return redirect()->route('categorias.index')->with('error', 'No puedes eliminar esta categoría porque tiene productos asociados.');
        }
    
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
    

}
