<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = ['nombre', 'descripcion', 'tipo_estado'];

    /**
     * Un estado puede estar en muchas personas.
     */
    public function personas()
    {
        return $this->hasMany(Persona::class);
    }

    /**
     * Un estado puede estar en muchos encargados.
     */
    public function encargados()
    {
        return $this->hasMany(Encargado::class);
    }

    /**
     * Un estado puede estar en muchos equipos.
     */
    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    /**
     * Un estado puede estar en muchos préstamos.
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}