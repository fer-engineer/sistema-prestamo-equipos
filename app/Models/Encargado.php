<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encargado extends Model
{
    use HasFactory;

    protected $table = 'encargados';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'estado_id',
        'user_id', // Agregado para la relación con User
    ];

    /**
     * Un encargado pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the state associated with the encargado.
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }

    /**
     * Get the loans associated with the encargado.
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }

    /**
     * Get the full name of the encargado.
     */
    public function getNombreCompletoAttribute(): string
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }
}
