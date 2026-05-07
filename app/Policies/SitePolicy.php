<?php

namespace App\Policies;

use App\Models\Site;
use App\Models\User;

class SitePolicy
{
    /**
     * Determina si el usuario puede actualizar la bitácora (Sitio).
     */
    public function update(User $user, Site $site): bool
    {
        // El usuario puede editar si es Administrador/Ministerio O si es el dueño de la bitácora
        return in_array($user->role, ['admin', 'ministerio']) || $user->id === $site->user_id;
    }
}
