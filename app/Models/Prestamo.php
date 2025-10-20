<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    protected $table = 'prestamos';

    protected $fillable = [
        'equipo_id',
        'encargado_id',
        'persona_id',
        'estado_id',
        'fecha_prestamo',
        'fecha_devolucion',
        'observaciones'
    ];

    protected $casts = [
        'fecha_prestamo' => 'date',
        'fecha_devolucion' => 'date',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class)->withDefault([
            'modelo' => 'Equipo no encontrado'
        ]);
    }

    public function encargado(): BelongsTo
    {
        return $this->belongsTo(Encargado::class)->withDefault([
            'nombre' => 'Encargado no encontrado'
        ]);
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class)->withDefault([
            'nombre' => 'Persona no encontrada'
        ]);
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }
}