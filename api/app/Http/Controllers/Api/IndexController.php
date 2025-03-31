<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Color;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talla;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ultimos = Producto::get()->take(10);
        $categorias = Categoria::all();
        $modelos = Modelo::all();
        $tallas = Talla::all();
        $colores = Color::all();
        $marcas = Marca::all();


        return response()->json([
            'ultimos'=>$ultimos,
            'categorias'=>$categorias,
            'modelos'=>$modelos,
            'tallas'=>$tallas,
            'colores'=>$colores,
            'marcas'=>$marcas

        ],200); 

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
