<?php

namespace App\Policies;

use App\Models\Credential;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CredentialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        // Assuming all authenticated users can view the credentials list
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credential  $credential
     * @return bool
     */
    public function view(User $user, Credential $credential)
    {
    // Allow the user to view the credential if they own it or if they are an admin
        return $user->id === $credential->user_id || $user->role === 'admin';
    }
    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // Assuming all authenticated users can create credentials
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credential  $credential
     * @return bool
     */
    public function update(User $user, Credential $credential)
    {
        return $user->id === $credential->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credential  $credential
     * @return bool
     */
    public function delete(User $user, Credential $credential)
    {
        return $user->id === $credential->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credential  $credential
     * @return bool
     */
    public function restore(User $user, Credential $credential)
    {
        return $user->id === $credential->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credential  $credential
     * @return bool
     */
    public function forceDelete(User $user, Credential $credential)
    {
        // Assuming users cannot force delete credentials for simplicity
        return false;
    }
}
