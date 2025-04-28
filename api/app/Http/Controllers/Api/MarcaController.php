<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Categoria;
class MarcaController extends Controller
{
    public function show($id)
    {
        $data = Producto::where("marca_id", $id)
            ->with('marca')
            ->get();
            $marca= Marca::find($id);
        return response()->json([
            'data'=> $data,
            'marca'=>$marca,
            
            'status'=>'success'
        ],200);
    }
}
