<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;
    protected $table = "marcas";
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Una marca tiene muchos equipos.
     */
    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class);
    }
}