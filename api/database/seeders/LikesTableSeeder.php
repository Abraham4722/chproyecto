<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('likes')->insert([
            ['usuario_id' => 1, 'producto_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['usuario_id' => 2, 'producto_id' => 2, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
