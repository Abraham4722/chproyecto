<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelos';
    protected $fillable = ['nombre', 'marca_id'];

    /**
     * Relación con la tabla marcas.
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id')->withDefault();
    }
}
