<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleDocente extends Model
{
    use HasFactory;

    protected $table = 'detalle_docente';

    protected $fillable = [
        'dui',
        'persona_id',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
}