<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Camiseta Nike',
                'descripcion' => 'Camiseta deportiva de alta calidad.',
                'precio' => 499.99,
                'stock' => 50,
                'categoria_id' => 1,
                'talla_id' => 1,
                'marca_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sudadera Adidas',
                'descripcion' => 'Sudadera cómoda y abrigadora.',
                'precio' => 899.99,
                'stock' => 30,
                'categoria_id' => 2,
                'talla_id' => 1,
                'marca_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
