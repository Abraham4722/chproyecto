<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikePublicacion extends Model
{
    use HasFactory;

    protected $table = 'likes'; // Asegúrate de que coincida con el nombre de la tabla

    protected $fillable = [
        'usuario_id',
        'producto_id',
    ];

    /**
     * Relación con el usuario que dio el like.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relación con el producto que recibió el like.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
