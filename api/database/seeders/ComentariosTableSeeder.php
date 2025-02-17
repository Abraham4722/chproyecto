<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComentariosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comentarios')->insert([
            ['usuario_id' => 1, 'producto_id' => 1, 'comentario' => 'Excelente calidad, lo recomiendo.', 'created_at' => now(), 'updated_at' => now()],
            ['usuario_id' => 2, 'producto_id' => 2, 'comentario' => 'Muy cómodo y buen precio.', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
