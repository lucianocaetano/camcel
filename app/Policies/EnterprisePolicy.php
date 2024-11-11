<?php

namespace App\Policies;

use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EnterprisePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->rol === "Admin";
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Enterprise $enterprise): bool
    {
        return $user->rol === "Admin"
            ? true: (
                $user->rol === "Enterprise" && $user->id === $enterprise->user_id
            );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         return $user->rol === "Admin" || $user->rol === "Enterprise" && !($user->enterprise());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Enterprise $enterprise): bool
    {
        return $user->rol === "Admin"
            ? true: (
                $user->rol === "Enterprise" && $user->id === $enterprise->user_id
            );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Enterprise $enterprise): bool
    {
        return $user->rol === "Admin"
            ? true: (
                $user->rol === "Enterprise" && $user->id === $enterprise->user_id
            );
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Enterprise $enterprise): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Enterprise $enterprise): bool
    {
        //
    }
}
