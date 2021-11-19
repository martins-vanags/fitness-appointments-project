<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->exists;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Appointment $appointment
     * @return bool
     */
    public function update(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Appointment $appointment
     * @return Response|bool
     */
    public function delete(User $user, Appointment $appointment): Response|bool
    {
        return $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can book the model.
     *
     * @param User $user
     * @param Appointment $appointment
     * @return Response|bool
     */
    public function book(User $user, Appointment $appointment): Response|bool
    {
        return $user->exists && !$appointment->users()->where('user_id', $user->id)->exists();
    }
}
