<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('marcas')->insert([
            ['nombre' => 'Nike', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Adidas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Puma', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
