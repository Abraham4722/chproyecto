<?php


namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\User;
use App\Models\Talla;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Pedido;
use App\Models\Color;
use App\Models\TallaProducto;   
use App\Models\Modelo;
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
    $tallas = Talla::all();
    $categorias = Categoria::all();
    $marcas = Marca::all();
    $modelos = Modelo::all();

    return view('admin.products', compact('productos', 'tallas', 'categorias', 'marcas','modelos'));
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
            'categoria_id' => 'required|exists:categorias,id', // ✅ CAMBIO AQUÍ
            'talla_id' => 'required|integer',
            'marca_id' => 'required|exists:marcas,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        // Guardar imagen en "public/images"
$imagen = $request->file('imagen');
$nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
$imagen->move(public_path('productos'), $nombreImagen);

// Ruta donde se guardó la imagen
$imagenPath = $nombreImagen;

    
        // Crear nuevo producto
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id, // ✅ CAMBIO AQUÍ
            'talla_id' => $request->talla_id,
            'marca_id' => $request->marca_id,
            'imagen' => $imagenPath
        ]);
    
        return redirect('/admin/products')->with('success', 'Producto agregado correctamente');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, Producto $producto)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'talla_id' => 'required|integer',
        'marca_id' => 'required|exists:marcas,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Si hay una nueva imagen, actualizarla
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path('productos'), $nombreImagen);
        $producto->imagen = $nombreImagen;
    }

    // Actualizar datos del producto
    $producto->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'categoria_id' => $request->categoria_id,
        'talla_id' => $request->talla_id,
        'marca_id' => $request->marca_id,
        'imagen' => $request->hasFile('imagen') ? $nombreImagen : $producto->imagen
    ]);

    return redirect('/admin/products')->with('success', 'Producto actualizado correctamente');
}
public function edit($id)
{
    $producto = Producto::find($id);
    $categorias = Categoria::all();
    $tallas = Talla::all();
    $marcas = Marca::all();
    $imagen = $producto->imagen; // Agregar la imagen a la vista
    
    return view('productos.edit', compact('producto', 'categorias', 'tallas', 'marcas', 'imagen'));
}

    /**
     * Update the specified resource in storage.
     */
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        

        return redirect('/admin/products')->with('success', 'Producto ELIMINADO correctamente');
    }
}

