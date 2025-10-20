<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'tipo_usuario_id',
        'estado_id',
    ];

    public function tipoUsuario(): BelongsTo
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario_id');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }

    public function detalleDocente(): HasOne
    {
        return $this->hasOne(DetalleDocente::class);
    }

    public function detalleEstudiante(): HasOne
    {
        return $this->hasOne(DetalleEstudiante::class);
    }

    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }

    /**
     * Get people of type 'Docente' who don't have a detail record yet.
     */
    public static function getAvailableDocentes()
    {
        return self::whereHas('tipoUsuario', function ($query) {
            $query->where('nombre', 'Docente');
        })->whereDoesntHave('detalleDocente')->get();
    }

    /**
     * Get people of type 'Estudiante' who don't have a detail record yet.
     */
    public static function getAvailableEstudiantes()
    {
        return self::whereHas('tipoUsuario', function ($query) {
            $query->where('nombre', 'Estudiante');
        })->whereDoesntHave('detalleEstudiante')->get();
    }
}