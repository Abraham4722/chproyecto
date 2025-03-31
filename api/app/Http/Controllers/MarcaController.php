<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::with('usuario')
            ->latest()
            ->paginate(10);

        return view('admin.marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('admin.marcas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:marcas',
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('marcas', 'public');
        }

        Marca::create($validated);

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca creada exitosamente');
    }

    public function show(Marca $marca)
    {
        return view('admin.marcas.show', compact('marca'));
    }

    public function edit(Marca $marca)
    {
        return view('admin.marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:marcas,nombre,'.$marca->id,
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'activo' => 'boolean',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($marca->imagen) {
                Storage::disk('public')->delete($marca->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('marcas', 'public');
        }

        $marca->update($validated);

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca actualizada exitosamente');
    }

    public function destroy(Marca $marca)
    {
        if ($marca->imagen) {
            Storage::disk('public')->delete($marca->imagen);
        }

        $marca->delete();

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca eliminada exitosamente');
    }
}