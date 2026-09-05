@extends('layouts.app')
@section('header', 'Dashboard Admin')
@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Selamat datang kembali</h1>
    <p class="page-subtitle">Berikut adalah ringkasan sistem pengaduan Anda.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-lg animate-fade-in animate-delay-1">
        <div class="stat-card stat-card-blue h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="stat-label">Total User</div>
                    <div class="stat-value">{{ $stats['users'] }}</div>
                </div>
                <div class="stat-icon stat-icon-blue">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg animate-fade-in animate-delay-2">
        <div class="stat-card stat-card-green h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="stat-label">Customer</div>
                    <div class="stat-value">{{ $stats['customers'] }}</div>
                </div>
                <div class="stat-icon stat-icon-green">
                    <i class="bi bi-person-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg animate-fade-in animate-delay-3">
        <div class="stat-card stat-card-amber h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="stat-label">Petugas</div>
                    <div class="stat-value">{{ $stats['petugas'] }}</div>
                </div>
                <div class="stat-icon stat-icon-amber">
                    <i class="bi bi-person-badge"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg animate-fade-in animate-delay-4">
        <div class="stat-card stat-card-red h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="stat-label">Admin</div>
                    <div class="stat-value">{{ $stats['admins'] }}</div>
                </div>
                <div class="stat-icon stat-icon-red">
                    <i class="bi bi-lightning"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg animate-fade-in animate-delay-5">
        <div class="stat-card stat-card-purple h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="stat-label">Pengaduan</div>
                    <div class="stat-value">{{ $stats['pengaduans'] }}</div>
                </div>
                <div class="stat-icon stat-icon-purple">
                    <i class="bi bi-inboxes"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.recent')
@endsection
