<?php

namespace App\Policies;

use App\Models\Pengaduan;
use App\Models\User;

class PengaduanPolicy
{
    public function viewAny(User $user): bool { return in_array($user->role, ['admin', 'petugas', 'customer'], true); }
    public function view(User $user, Pengaduan $pengaduan): bool { return !$user->isCustomer() || $pengaduan->user_id === $user->id; }
    public function create(User $user): bool { return $user->isAdmin() || $user->isCustomer(); }
    public function update(User $user, Pengaduan $pengaduan): bool { return $user->isAdmin(); }
    public function delete(User $user, Pengaduan $pengaduan): bool { return $user->isAdmin(); }
}
