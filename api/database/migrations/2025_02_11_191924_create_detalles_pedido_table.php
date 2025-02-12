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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->decimal('total', 10, 2);
            $table->string('estado')->default('pendiente'); // Pendiente, Enviado, Completado, Cancelado
            $table->dateTime('fecha_pedido');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pedido');
    }
};
