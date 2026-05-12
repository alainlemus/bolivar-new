<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PageView;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageViewPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PageView');
    }

    public function view(AuthUser $authUser, PageView $pageView): bool
    {
        return $authUser->can('View:PageView');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PageView');
    }

    public function update(AuthUser $authUser, PageView $pageView): bool
    {
        return $authUser->can('Update:PageView');
    }

    public function delete(AuthUser $authUser, PageView $pageView): bool
    {
        return $authUser->can('Delete:PageView');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PageView');
    }

    public function restore(AuthUser $authUser, PageView $pageView): bool
    {
        return $authUser->can('Restore:PageView');
    }

    public function forceDelete(AuthUser $authUser, PageView $pageView): bool
    {
        return $authUser->can('ForceDelete:PageView');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PageView');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PageView');
    }

    public function replicate(AuthUser $authUser, PageView $pageView): bool
    {
        return $authUser->can('Replicate:PageView');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PageView');
    }

}