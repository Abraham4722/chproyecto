<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Color;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::latest()->paginate(10);
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $tallas = Talla::all();
        $colores = Color::all();
        return view('admin.categorias', compact('colores','tallas','modelos','marcas','categorias')); // Ajustado a tu estructura de vistas
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
        // Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:colores',
            'codigo_hex' => 'required|string|max:7|unique:colores',
        ]);
    
        try {
            // Crear el color
            $color = Color::create($validated);
    
            // Redirigir con mensaje de éxito
            return redirect()->route('admin.colores')
                ->with('success', 'Color creado exitosamente');
        } catch (\Exception $e) {
            // Registrar el error en logs
            \Log::error('Error al crear el color: ' . $e->getMessage());
    
            // Redirigir con mensaje de error
            return back()->with('error', 'Hubo un error al crear el color.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        // Validación de datos para actualizar el color
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:colores,nombre,' . $color->id,
            'codigo_hex' => 'required|string|max:7|unique:colores,codigo_hex,' . $color->id,
        ]);

        try {
            // Actualizar el color
            $color->update($validated);

            return redirect()->route('admin.colores')
                ->with('success', 'Color actualizado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar el color: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al actualizar el color.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        //crear el destroy
        try {
            // Intentar eliminar el color
            $color->delete();

            return redirect()->route('admin.colores')
                ->with('success', 'Color eliminado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar el color: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al eliminar el color.');
        }
    }
}
