<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipos_usuario';

    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Un tipo de usuario puede tener muchas personas.
     */
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }
}
