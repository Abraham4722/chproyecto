<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pedidos')->insert([
            ['usuario_id' => 1, 'total' => 1499.99, 'created_at' => now(), 'fecha_pedido' => now(), 'updated_at' => now()],
            ['usuario_id' => 2, 'total' => 899.99, 'created_at' => now(), 'fecha_pedido' => now(), 'updated_at' => now()]
        ]);
    }
}
