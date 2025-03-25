<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion']; // Se agregó 'descripcion'

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
    
}
