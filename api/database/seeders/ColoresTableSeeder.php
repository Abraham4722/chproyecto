<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColoresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('colores')->insert([
            ['nombre' => 'Rojo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Azul', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Negro', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
