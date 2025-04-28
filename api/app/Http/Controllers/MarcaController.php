<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Categoria;  // Si estás usando categorías en tu vista
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Producto;
use App\Models\Modelo;
use App\Models\Talla;
use App\Models\Color;

class MarcaController extends Controller
{
    public function index()
    {
        // Obtenemos las marcas y otros datos necesarios
        $modelos = Modelo::latest()->paginate(10);
        $marcas = Marca::all();  // Obtener todas las marcas
        $productos = Producto::all();  // Si necesitas productos
        $tallas = Talla::all();  // Si necesitas tallas
        $colores = Color::all();  // Si necesitas colores
        
    
        // Verificar si la colección de marcas está vacía
        $marcas = Marca::all();
        if ($marcas->isEmpty()) {
            // Si la colección está vacía, puedes manejarlo aquí
            Log::warning('No hay marcas disponibles.');
        } else {
            Log::info('Marcas obtenidas correctamente.');
        }
        
    
        $categorias = Categoria::all();  // Si necesitas categorías
    
        // Pasamos las marcas y los otros datos a la vista
        return view('admin.categorias', compact('modelos', 'marcas', 'categorias', 'productos', 'tallas', 'colores'));
    }
    


    public function create()
    {
        return view('admin.marca.create');
    }

    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:marcas',
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validación de imagen
        ]);

        try {
            // Intentar crear la marca
            $marca = Marca::create($validated);

            if ($request->hasFile('imagen')) {
                $validated['imagen'] = $request->file('imagen')->store('marcas', 'public');
                $marca->update(['imagen' => $validated['imagen']]);
            }

            return redirect()->route('admin.marcas')
                ->with('success', 'Marca creada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al crear la marca: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al crear la marca.');
        }
    }

    public function show(Marca $marca)
    {
        return view('admin.marcas.show', compact('marca'));
    }

    public function edit(Marca $marca)
    {
       // Retornar la vista de edición con la marca seleccionada
        return view('admin.marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:marcas,nombre,' . $marca->id
        ]);
    
        $marca->update($validated);
        return redirect()->route('admin.marcas')->with('success', 'Marca actualizada');
    }
  
    public function destroy(Marca $marca)
    {
        try {
            // Eliminar la imagen si existe
            if ($marca->imagen) {
                Storage::disk('public')->delete($marca->imagen);
            }

            // Eliminar la marca
            $marca->delete();

            return redirect()->route('admin.marcas')
                ->with('success', 'Marca eliminada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar la marca: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al eliminar la marca.');
        }
    }
}
