<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likes_publicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('usuario_id');
            $table->integer('publicacion_id');
            $table->dateTime('fecha_like');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes_publicaciones');
    }
};
