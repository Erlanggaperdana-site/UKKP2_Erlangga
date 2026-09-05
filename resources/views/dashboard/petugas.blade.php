@extends('layouts.app')
@section('header', 'Dashboard Petugas')
@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Dashboard Petugas</h1>
    <p class="page-subtitle">Kelola dan pantau semua pengaduan yang masuk.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6 animate-fade-in animate-delay-1">
        <div class="stat-card stat-card-blue h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="stat-label">Total Pengaduan</div>
                    <div class="stat-value">{{ $stats['pengaduans'] }}</div>
                </div>
                <div class="stat-icon stat-icon-blue">
                    <i class="bi bi-inboxes"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 animate-fade-in animate-delay-2">
        <div class="stat-card stat-card-green h-100">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <div class="stat-label">Total Customer</div>
                    <div class="stat-value">{{ $stats['customers'] }}</div>
                </div>
                <div class="stat-icon stat-icon-green">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.recent')
@endsection
