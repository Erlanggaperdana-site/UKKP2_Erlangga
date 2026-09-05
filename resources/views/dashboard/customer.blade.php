@extends('layouts.app')
@section('header', 'Dashboard Customer')
@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
        <h1 class="page-title">Dashboard Customer</h1>
        <p class="page-subtitle">Kelola pengaduan Anda secara aman dan terpercaya.</p>
    </div>
    <a href="{{ route('pengaduans.create') }}" class="btn btn-primary d-flex align-items-center">
        <i class="bi bi-plus-lg me-2"></i>Buat Pengaduan
    </a>
</div>

<div class="hero-card mb-4 animate-fade-in">
    <div class="d-flex align-items-start justify-content-between position-relative z-1">
        <div>
            <div class="hero-label">Total Pengaduan Saya</div>
            <div class="hero-value">{{ $total }}</div>
            <div class="hero-hint">Pengaduan yang telah Anda ajukan</div>
        </div>
        <div class="hero-icon">
            <i class="bi bi-inboxes"></i>
        </div>
    </div>
</div>

<div class="content-card animate-fade-in animate-delay-1">
    <div class="card-header">
        Pengaduan Terbaru
    </div>
    @include('pengaduans.table', ['pengaduans' => $pengaduans, 'simple' => true])
</div>
@endsection
