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


class TallaController extends Controller
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
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:tallas',
            
            ]);

        try {
            // Intentar crear la talla
            $talla = Talla::create($validated);

          

            return redirect()->route('admin.tallas')
                ->with('success', 'talla creada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al crear la talla: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al crear la talla.');
        }
    }

  
    public function edit(Talla $talla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Talla $talla)
    {
        // Validación de datos para actualizar la talla
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:tallas,nombre,' . $talla->id,
        ]);

        try {
            // Actualizar la talla
            $talla->update($validated);

            return redirect()->route('admin.tallas')
                ->with('success', 'Talla actualizada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar la talla: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al actualizar la talla.');
        }
    }

  
    public function destroy(Talla $talla)
    {
        try {
            
            $talla->delete();

            return redirect()->route('admin.tallas')
                ->with('success', 'Talla eliminada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar la talla: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al eliminar la Talla.');
        }
    }
}

