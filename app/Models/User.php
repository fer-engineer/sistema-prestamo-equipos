<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Agregado para la relación con Rol
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Un usuario tiene un rol.
     */
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'role_id', 'id');
    }

    /**
     * Un usuario tiene un perfil de encargado.
     */
    public function encargado(): HasOne
    {
        return $this->hasOne(Encargado::class);
    }

 // Nombre legible del rol
public function getRolNombreAttribute()
{
    return $this->rol ? $this->rol->nombre : 'Usuario';
}

// Nombre corto del rol
public function getRolCortoAttribute()
{
    return match($this->rol?->nombre) {
        'Administrador' => 'Admin',
        'Encargado' => 'Encargado',
        default => 'User',
    };
}

}