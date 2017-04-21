<?php

namespace App\Policies;

use App\User;
use App\Equipe;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the equipe.
     *
     * @param  \App\User  $user
     * @param  \App\Equipe  $equipe
     * @return mixed
     */
    public function view(User $user, Equipe $equipe)
    {
        //
    }

    /**
     * Determine whether the user can create equipes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->hasAdminRole() || $user->hasTeam_AdminRole());
    }

    /**
     * Determine whether the user can update the equipe.
     *
     * @param  \App\User  $user
     * @param  \App\Equipe  $equipe
     * @return mixed
     */
    public function update(User $user, Equipe $equipe)
    {
        //
        return $user->id === $equipe->admin_id || $user->hasAdminRole();
    }

    /**
     * Determine whether the user can delete the equipe.
     *
     * @param  \App\User  $user
     * @param  \App\Equipe  $equipe
     * @return mixed
     */
    public function delete(User $user, Equipe $equipe)
    {
        //
        return $user->id === $equipe->admin_id || $user->hasAdminRole();
    }
}
