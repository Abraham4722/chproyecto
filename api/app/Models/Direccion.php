<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';
    protected $fillable = ['usuario_id', 'calle', 'ciudad', 'estado', 'codigo_postal'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
