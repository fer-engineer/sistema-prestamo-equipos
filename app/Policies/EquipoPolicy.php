<?php

namespace App\Policies;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EquipoPolicy
{
    /**
     * Determina si el usuario puede ver la lista de equipos.
     */
    public function viewAny(User $user): bool
    {
        return $user->rol && in_array($user->rol->nombre, ['Administrador', 'Encargado']);
    }

    /**
     * Determina si el usuario puede ver un equipo específico.
     */
    public function view(User $user, Equipo $equipo): bool
    {
        return $user->rol && in_array($user->rol->nombre, ['Administrador', 'Encargado']);
    }

    /**
     * Determina si el usuario puede crear equipos.
     */
    public function create(User $user): bool
    {
        return $user->rol && in_array($user->rol->nombre, ['Administrador', 'Encargado']);
    }

    /**
     * Determina si el usuario puede actualizar equipos.
     */
    public function update(User $user, Equipo $equipo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }

    /**
     * Determina si el usuario puede eliminar equipos.
     */
    public function delete(User $user, Equipo $equipo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }

    /**
     * Determina si el usuario puede restaurar equipos eliminados.
     */
    public function restore(User $user, Equipo $equipo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un equipo.
     */
    public function forceDelete(User $user, Equipo $equipo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }
}