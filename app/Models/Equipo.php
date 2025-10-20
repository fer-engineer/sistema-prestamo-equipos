<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'marca_id',
        'modelo',
        'descripcion',
        'estado_id',
        'fecha_adquisicion'
    ];

    protected $casts = [
        'fecha_adquisicion' => 'date',
    ];

    /**
     * Un equipo pertenece a una marca.
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    /**
     * Un equipo tiene un estado.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    /**
     * Un equipo puede tener muchos préstamos.
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'equipo_id');
    }
}