<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnviosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('envios')->insert([
            ['pedido_id' => 1, 'direccion_id' => 1, 'estado' => 'En camino', 'created_at' => now(), 'updated_at' => now()],
            ['pedido_id' => 2, 'direccion_id' => 2, 'estado' => 'Pendiente', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
