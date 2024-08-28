<?php

namespace App\Policies;

use App\Models\Url;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UrlPolicy
{
    /**
     * Determine whether the user can view any URL Model.
     */
    public function viewAny(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }

    /**
     * Determine whether the user can view the URL model.
     */
    public function view(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the URL model.
     */
    public function update(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }

    /**
     * Determine whether the user can delete the URL model.
     */
    public function delete(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }

    /**
     * Determine whether the user can restore the URL model.
     */
    public function restore(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }

    /**
     * Determine whether the user can permanently delete the URL model.
     */
    public function forceDelete(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }
}
