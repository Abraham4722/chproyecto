<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Deportiva', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Formal', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
