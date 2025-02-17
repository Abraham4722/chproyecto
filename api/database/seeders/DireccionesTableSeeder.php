<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DireccionesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('direcciones')->insert([
            ['usuario_id' => 1, 'calle' => 'Calle 123', 'colonia' => 'Centro', 'ciudad' => 'CDMX', 'estado' => 'CDMX', 'codigo_postal' => '01000', 'created_at' => now(), 'updated_at' => now()],
            ['usuario_id' => 2, 'calle' => 'Avenida 456', 'colonia' => 'Sur', 'ciudad' => 'Guadalajara', 'estado' => 'Jalisco', 'codigo_postal' => '44000', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
