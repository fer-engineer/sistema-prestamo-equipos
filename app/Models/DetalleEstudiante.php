<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleEstudiante extends Model
{
    use HasFactory;

    protected $table = 'detalle_estudiante';

    protected $fillable = [
        'nie',
        'persona_id',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
}