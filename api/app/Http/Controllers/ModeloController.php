<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Talla;
use App\Models\Color;


class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::latest()->paginate(10);
        $marcas = Marca::all();
        $modelos = Modelo::with('marca')->get(); // Relación con Marca
        $productos = Producto::all();
        $tallas = Talla::all();
        $colores = Color::all();
        
        return view('admin.categorias', compact('categorias', 'marcas', 'modelos', 'productos', 'tallas', 'colores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:modelos',
            'marca_id' => 'required|exists:marcas,id', // Validar que la marca exista
        ]);

        try {
            // Crear el modelo con la marca seleccionada
            $modelo = Modelo::create($validated);

            return redirect()->route('admin.modelos')
                ->with('success', 'Modelo creado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al crear el modelo: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al crear el modelo.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modelo $modelo)
    {
        $marcas = Marca::all(); // Obtener todas las marcas para el select
        return view('admin.edit_modelo', compact('modelo', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modelo $modelo)
    {
        // Validación de datos para actualizar el modelo
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:modelos,nombre,' . $modelo->id,
            'marca_id' => 'required|exists:marcas,id', // Validar que la marca exista
        ]);

        try {
            // Actualizar el modelo
            $modelo->update($validated);

            return redirect()->route('admin.modelos')
                ->with('success', 'Modelo actualizado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar el modelo: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al actualizar el modelo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelo $modelo)
    {
        try {
            $modelo->delete();

            return redirect()->route('admin.modelos')
                ->with('success', 'Modelo eliminado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar el modelo: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al eliminar el modelo.');
        }
    }
}
