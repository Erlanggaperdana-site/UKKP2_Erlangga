@extends('layouts.app')
@section('content')
<div class="auth-card mx-auto">
    <div class="text-center mb-4">
        <div class="auth-brand justify-content-center">
            <div class="brand-icon">
                <i class="bi bi-shield-check text-white"></i>
            </div>
            <span>SPM</span>
        </div>
        <h1 class="h4 fw-bold text-dark mb-2">Daftar Akun</h1>
        <p class="auth-subtitle">Buat akun baru sebagai customer</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="needs-validation">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
            <div class="form-text-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
            <div class="form-text-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
            <div class="form-text-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
            <div class="form-text-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password</label>
            <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required>
            @error('password_confirmation')
            <div class="form-text-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>

    <div class="mt-4 pt-4 border-top text-center">
        <p class="text-muted" style="font-size: 13.5px;">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Masuk di sini</a></p>
    </div>
</div>
<div class="auth-footer">
    © 2026 Sistem Pengaduan Masyarakat. Semua hak dilindungi.
</div>
@endsection
