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


class CategoriaController extends Controller
{
    // Constantes para validación
    private const VALIDATION_RULES = [
        'nombre' => 'required|string|max:100|unique:categorias',
        'descripcion' => 'nullable|string|max:500',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'eliminar_imagen' => 'nullable|boolean'
    ];

    private const VALIDATION_MESSAGES = [
        'nombre.required' => 'El nombre es obligatorio',
        'nombre.max' => 'El nombre no debe exceder 100 caracteres',
        'nombre.unique' => 'El nombre de categoría ya existe',
        'descripcion.max' => 'La descripción no debe exceder 500 caracteres',
        'imagen.image' => 'El archivo debe ser una imagen válida',
        'imagen.mimes' => 'Solo se permiten imágenes JPEG, PNG, JPG o WEBP',
        'imagen.max' => 'La imagen no debe pesar más de 2MB'
    ];

    public function index()
    {
        $categorias = Categoria::latest()->paginate(10);
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $tallas = Talla::all();
        $colores = Color::all();
        return view('admin.categorias', compact('colores','tallas','modelos','marcas','categorias')); // Ajustado a tu estructura de vistas
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            self::VALIDATION_RULES,
            self::VALIDATION_MESSAGES
        );

        try {
            // Procesar imagen si existe
            if ($request->hasFile('imagen')) {
                $validated['imagen'] = $this->handleImageUpload($request->file('imagen'));
            }

            Categoria::create($validated);

            return redirect()
                ->route('admin.categorias')
                ->with('success', 'Categoría creada correctamente');

        } catch (\Exception $e) {
            Log::error('Error al crear categoría: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error al crear la categoría: ' . $this->getUserFriendlyError($e));
        }
    }

    public function update(Request $request, Categoria $categoria)
    {
        $rules = self::VALIDATION_RULES;
        $rules['nombre'] = 'required|string|max:100|unique:categorias,nombre,'.$categoria->id;

        $validated = $request->validate($rules, self::VALIDATION_MESSAGES);

        try {
            // Manejar eliminación de imagen si se solicita
            if ($request->boolean('eliminar_imagen')) {
                $this->deleteImageIfExists($categoria->imagen);
                $validated['imagen'] = null;
            }
            
            // Manejar nueva imagen si se sube
            if ($request->hasFile('imagen')) {
                $this->deleteImageIfExists($categoria->imagen);
                $validated['imagen'] = $this->handleImageUpload($request->file('imagen'));
            }

            $categoria->update($validated);

            return redirect()
                ->route('admin.categorias')
                ->with('success', 'Categoría actualizada correctamente');

        } catch (\Exception $e) {
            Log::error('Error al actualizar categoría ID ' . $categoria->id . ': ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error al actualizar la categoría: ' . $this->getUserFriendlyError($e));
        }
    }

    public function destroy(Categoria $categoria)
    {
        try {
            // Eliminar imagen asociada si existe
            $this->deleteImageIfExists($categoria->imagen);
            
            $categoria->delete();

            return redirect()
                ->route('admin.categorias')
                ->with('success', 'Categoría eliminada correctamente');

        } catch (\Exception $e) {
            Log::error('Error al eliminar categoría ID ' . $categoria->id . ': ' . $e->getMessage());
            return back()
                ->with('error', 'Error al eliminar la categoría: ' . $this->getUserFriendlyError($e));
        }
    }

    /**
     * Métodos auxiliares privados
     */
    
    private function handleImageUpload($image)
    {
        // Guardar imagen en storage/public/categorias
        return $image->store('categorias', 'public');
    }

    private function deleteImageIfExists($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
            return true;
        }
        return false;
    }

    private function getUserFriendlyError(\Exception $e)
    {
        // Mensajes más amigables para el usuario
        if (str_contains($e->getMessage(), 'No such file or directory')) {
            return 'Error al acceder al archivo de imagen.';
        }
        
        if (str_contains($e->getMessage(), 'Allowed memory size')) {
            return 'La imagen es demasiado grande. Intente con una más pequeña.';
        }
        
        return 'Ocurrió un error inesperado.';
    }
}