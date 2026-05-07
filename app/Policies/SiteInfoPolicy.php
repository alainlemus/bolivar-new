<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SiteInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteInfoPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SiteInfo');
    }

    public function view(AuthUser $authUser, SiteInfo $siteInfo): bool
    {
        return $authUser->can('View:SiteInfo');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SiteInfo');
    }

    public function update(AuthUser $authUser, SiteInfo $siteInfo): bool
    {
        return $authUser->can('Update:SiteInfo');
    }

    public function delete(AuthUser $authUser, SiteInfo $siteInfo): bool
    {
        return $authUser->can('Delete:SiteInfo');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SiteInfo');
    }

    public function restore(AuthUser $authUser, SiteInfo $siteInfo): bool
    {
        return $authUser->can('Restore:SiteInfo');
    }

    public function forceDelete(AuthUser $authUser, SiteInfo $siteInfo): bool
    {
        return $authUser->can('ForceDelete:SiteInfo');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SiteInfo');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SiteInfo');
    }

    public function replicate(AuthUser $authUser, SiteInfo $siteInfo): bool
    {
        return $authUser->can('Replicate:SiteInfo');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SiteInfo');
    }

}