<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show($id)
    {
//selecionar los datos del pedido

        $pedido = Pedido::with('detalles.producto')->find($id); 
        $envio = null;
        $pago = null;
        if($pedido->detalles->first()){
            $envio = $pedido->detalles->first()->envio;
            $pago = $pedido->detalles->first()->pago;
        }
   
    
        $productos = $pedido->productos;
        $detalles = $pedido->detalles;

        return view('admin.detalles', compact('pedido', 'envio', 'pago', 'productos', 'detalles'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
