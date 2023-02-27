<?php

namespace App\Policies;

use App\Models\User;
use App\Models\XRayRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class XRayRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_x::ray::request');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, XRayRequest $xRayRequest)
    {
        return $user->can('view_x::ray::request');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_x::ray::request');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, XRayRequest $xRayRequest)
    {
        return $user->can('update_x::ray::request');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, XRayRequest $xRayRequest)
    {
        return $user->can('delete_x::ray::request');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_x::ray::request');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, XRayRequest $xRayRequest)
    {
        return $user->can('force_delete_x::ray::request');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_x::ray::request');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, XRayRequest $xRayRequest)
    {
        return $user->can('restore_x::ray::request');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_x::ray::request');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, XRayRequest $xRayRequest)
    {
        return $user->can('replicate_x::ray::request');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_x::ray::request');
    }

}
