<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('imagenes')->insert([
            ['producto_id' => 1, 'url' => 'imagenes/camiseta-nike.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['producto_id' => 2, 'url' => 'imagenes/sudadera-adidas.jpg', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
