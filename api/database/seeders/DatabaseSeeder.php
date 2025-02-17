<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriasTableSeeder::class,
            TallasTableSeeder::class,
            MarcasTableSeeder::class,
            ProductosTableSeeder::class,
            LikesTableSeeder::class,
            ComentariosTableSeeder::class,
            PedidosTableSeeder::class,
            VentasTableSeeder::class,
            DireccionesTableSeeder::class,
            EnviosTableSeeder::class,
            ColoresTableSeeder::class,
            ImagenesTableSeeder::class,
        ]);
    }
}
