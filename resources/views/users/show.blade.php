@extends('layouts.app')
@section('header', 'Detail User')
@section('content')
<div style="max-width: 720px;">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">Detail User</h1>
            <p class="page-subtitle">Informasi lengkap pengguna</p>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-light">
            Kembali
        </a>
    </div>

    <div class="detail-card">
        <div class="detail-header">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-lg position-relative z-1">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="position-relative z-1">
                    <h2 class="h4 text-white fw-bold mb-1">{{ $user->name }}</h2>
                    <span class="badge bg-white bg-opacity-25 text-white">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-body">
            <div class="detail-item">
                <div class="detail-item-label">Email</div>
                <div class="detail-item-value fs-5">{{ $user->email }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-item-label">Nomor Telepon</div>
                <div class="detail-item-value fs-5">{{ $user->phone ?: '-' }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-item-label">Role</div>
                <div class="detail-item-value mt-1">
                    <span class="badge {{ $user->role === 'admin' ? 'badge-role-admin' : ($user->role === 'petugas' ? 'badge-role-petugas' : 'badge-role-customer') }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>

            <div class="detail-item border-0">
                <div class="detail-item-label">Dibuat</div>
                <div class="detail-item-value">{{ $user->created_at->format('d M Y H:i') }}</div>
            </div>
        </div>

        <div class="card-body bg-light border-top d-flex gap-2">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                Edit User
            </a>
            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
