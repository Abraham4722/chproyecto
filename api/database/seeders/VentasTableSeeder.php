<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentasTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ventas')->insert([
            ['pedido_id' => 1, 'monto' => 1499.99, 'estado' => 'completado', 'created_at' => now(), 'usuario_id' => 1,'total' => 1,'fecha_venta' => now(), 'updated_at' => now()],
            ['pedido_id' => 2, 'monto' => 899.99, 'estado' => 'pendiente', 'created_at' => now(), 'usuario_id' => 1,'total' => 1, 'fecha_venta' => now(), 'updated_at' => now()]
        ]);
    }
}
