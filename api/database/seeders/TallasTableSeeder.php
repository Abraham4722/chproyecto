<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TallasTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tallas')->insert([
            ['nombre' => 'S', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'M', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'L', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'XL', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
