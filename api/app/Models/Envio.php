<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Envio extends Model
{
    use HasFactory;

    protected $table = 'envios';
    protected $fillable = ['pedido_id', 'direccion_id', 'fecha_envio', 'estado'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }
}
