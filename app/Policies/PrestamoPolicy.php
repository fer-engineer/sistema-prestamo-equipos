<?php

namespace App\Policies;

use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrestamoPolicy
{
    /**
     * Determina si el usuario puede ver la lista de préstamos.
     */
    public function viewAny(User $user): bool
    {
        return $user->rol && in_array($user->rol->nombre, ['Administrador', 'Encargado']);
    }

    /**
     * Determina si el usuario puede ver un préstamo específico.
     */
    public function view(User $user, Prestamo $prestamo): bool
    {
        return $user->rol && in_array($user->rol->nombre, ['Administrador', 'Encargado']);
    }

    /**
     * Determina si el usuario puede crear préstamos.
     */
    public function create(User $user): bool
    {
        return $user->rol && in_array($user->rol->nombre, ['Administrador', 'Encargado']);
    }

    /**
     * Determina si el usuario puede actualizar un préstamo.
     */
    public function update(User $user, Prestamo $prestamo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }

    /**
     * Determina si el usuario puede eliminar un préstamo.
     */
    public function delete(User $user, Prestamo $prestamo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }

    /**
     * Determina si el usuario puede restaurar un préstamo eliminado.
     */
    public function restore(User $user, Prestamo $prestamo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un préstamo.
     */
    public function forceDelete(User $user, Prestamo $prestamo): bool
    {
        return $user->rol && $user->rol->nombre === 'Administrador';
    }
}
