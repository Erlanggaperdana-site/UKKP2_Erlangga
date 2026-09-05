@extends('layouts.app')
@section('header', 'Manajemen User')
@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
        <h1 class="page-title">Manajemen User</h1>
        <p class="page-subtitle">Kelola semua pengguna sistem</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center">
        <i class="bi bi-plus-lg me-2"></i>Tambah User
    </a>
</div>

<div class="content-card">
    <div class="card-body border-bottom bg-light">
        <form method="GET" action="{{ route('users.index') }}" class="row g-3 align-items-end">
            <div class="col-sm-4 col-lg-3">
                <label class="form-label">Cari</label>
                <input type="text" name="search" class="form-control" placeholder="Nama atau email" value="{{ request('search') }}">
            </div>

            <div class="col-sm-4 col-lg-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="">Semua role</option>
                    @foreach(['admin', 'petugas', 'customer'] as $role)
                        @if(auth()->user()->isAdmin() || $role !== 'admin')
                            <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-auto d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Filter
                </button>
                @if(request('search') || request('role'))
                <a href="{{ route('users.index') }}" class="btn btn-light">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-muted">{{ $users->firstItem() + $loop->index }}</td>
                    <td class="fw-medium text-dark">{{ $user->name }}</td>
                    <td class="text-muted">{{ $user->email }}</td>
                    <td class="text-muted">{{ $user->phone ?: '-' }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-role-admin' : ($user->role === 'petugas' ? 'badge-role-petugas' : 'badge-role-customer') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="text-muted">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('users.show', $user) }}" class="btn btn-primary btn-sm">
                                Detail
                            </a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-light btn-sm">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <strong>Tidak ada data user</strong>
                            <p>Tidak ada user yang sesuai dengan filter Anda</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-body bg-light border-top py-3 px-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
