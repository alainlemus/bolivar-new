<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Obituary;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObituaryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Obituary');
    }

    public function view(AuthUser $authUser, Obituary $obituary): bool
    {
        return $authUser->can('View:Obituary');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Obituary');
    }

    public function update(AuthUser $authUser, Obituary $obituary): bool
    {
        return $authUser->can('Update:Obituary');
    }

    public function delete(AuthUser $authUser, Obituary $obituary): bool
    {
        return $authUser->can('Delete:Obituary');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Obituary');
    }

    public function restore(AuthUser $authUser, Obituary $obituary): bool
    {
        return $authUser->can('Restore:Obituary');
    }

    public function forceDelete(AuthUser $authUser, Obituary $obituary): bool
    {
        return $authUser->can('ForceDelete:Obituary');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Obituary');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Obituary');
    }

    public function replicate(AuthUser $authUser, Obituary $obituary): bool
    {
        return $authUser->can('Replicate:Obituary');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Obituary');
    }

}