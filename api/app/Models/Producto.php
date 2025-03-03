<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    
    protected $fillable = ['nombre', 'descripcion', 'precio', 'categoria_id', 'marca_id'];

    protected $casts = ['precio' => 'decimal:2'];

    protected $with = ['categoria', 'marca'];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function marca() {
        return $this->belongsTo(Marca::class);
    }

    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function imagenes() {
        return $this->hasMany(Imagen::class);
    }

    public function getPrecioFormateadoAttribute() {
        return '$' . number_format($this->precio, 2, '.', ',');
    }
}
