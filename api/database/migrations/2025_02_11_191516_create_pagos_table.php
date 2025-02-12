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
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('usuario_id');
            $table->foreignId('producto_id')->constrained('productos');
            $table->decimal('monto', 10, 2);
            $table->dateTime('fecha_pago');
            $table->string('metodo_pago');
            $table->string('estado'); // Pagado, pendiente, rechazado
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
