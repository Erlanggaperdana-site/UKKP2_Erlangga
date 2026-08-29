<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pengaduan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengaduanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pengaduan');
    }

    public function view(AuthUser $authUser, Pengaduan $pengaduan): bool
    {
        return $authUser->can('View:Pengaduan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pengaduan');
    }

    public function update(AuthUser $authUser, Pengaduan $pengaduan): bool
    {
        return $authUser->can('Update:Pengaduan');
    }

    public function delete(AuthUser $authUser, Pengaduan $pengaduan): bool
    {
        return $authUser->can('Delete:Pengaduan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Pengaduan');
    }

    public function restore(AuthUser $authUser, Pengaduan $pengaduan): bool
    {
        return $authUser->can('Restore:Pengaduan');
    }

    public function forceDelete(AuthUser $authUser, Pengaduan $pengaduan): bool
    {
        return $authUser->can('ForceDelete:Pengaduan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pengaduan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pengaduan');
    }

    public function replicate(AuthUser $authUser, Pengaduan $pengaduan): bool
    {
        return $authUser->can('Replicate:Pengaduan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pengaduan');
    }

}