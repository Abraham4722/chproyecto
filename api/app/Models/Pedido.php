<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'total', 'estado', 'direccion'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }

    

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalles_pedido')
                    ->withPivot('cantidad');
    }
}