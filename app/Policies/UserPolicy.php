<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function view(User $user): Response|bool
    {
        return $user->exists;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

}
