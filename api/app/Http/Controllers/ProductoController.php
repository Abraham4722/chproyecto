<?php


namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
class ProductoController extends Controller
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $productos = Producto::all();
        return response()->json($productos);
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
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria' => 'required|string',
        'talla' => 'required|string',
        'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Guardar imagen en "public/images"
    $imagenPath = $request->file('imagen')->store('images', 'public');

    // Crear nuevo producto
    Producto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'categoria' => $request->categoria,
        'talla' => $request->talla,
        'imagen' => $imagenPath
    ]);

    return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente');
}


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}

