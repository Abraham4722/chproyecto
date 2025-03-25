<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ultimos = Product::get()->orderBy('created_at','DESC')->take(10);
        $categorias = Category::all();
        $modelos = models::all();
        $tallas = Tallas::all();
        $colores = Colores::all();
        $marcas = Marcas::all();


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
