@extends('layouts.app')
@section('header', 'Profil Saya')
@section('content')
<div style="max-width: 720px;">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">Profil Saya</h1>
            <p class="page-subtitle">Kelola informasi akun Anda</p>
        </div>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
            Edit Profil
        </a>
    </div>

    <div class="detail-card">
        <div class="detail-header">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-lg position-relative z-1">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="position-relative z-1">
                    <h2 class="h4 text-white fw-bold mb-1">{{ auth()->user()->name }}</h2>
                    <span class="badge bg-white bg-opacity-25 text-white">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-body">
            <div class="detail-item">
                <div class="detail-item-label">Nama Lengkap</div>
                <div class="detail-item-value fs-5">{{ auth()->user()->name }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-item-label">Email</div>
                <div class="detail-item-value fs-5">{{ auth()->user()->email }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-item-label">Nomor Telepon</div>
                <div class="detail-item-value fs-5">{{ auth()->user()->phone ?: '-' }}</div>
            </div>

            <div class="detail-item border-0">
                <div class="detail-item-label">Role</div>
                <div class="detail-item-value mt-1">
                    <span class="badge {{ auth()->user()->role === 'admin' ? 'badge-role-admin' : (auth()->user()->role === 'petugas' ? 'badge-role-petugas' : 'badge-role-customer') }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body bg-light border-top d-flex gap-2">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                Edit Profil
            </a>
            <a href="{{ route('profile.password') }}" class="btn btn-light">
                Ubah Password
            </a>
        </div>
    </div>
</div>
@endsection
