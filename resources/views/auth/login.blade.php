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
        <h1 class="h4 fw-bold text-dark mb-2">Selamat datang</h1>
        <p class="auth-subtitle">Masuk ke Sistem Pengaduan Masyarakat</p>
    </div>

    <form method="POST" action="{{ route('login.attempt') }}" class="needs-validation">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email')
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

        <div class="mb-4 form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label text-muted" style="font-size: 13.5px;">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Masuk</button>
    </form>

    <div class="mt-4 pt-4 border-top text-center">
        <p class="text-muted" style="font-size: 13.5px;">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-medium">Daftar sebagai customer</a></p>
    </div>
</div>
<div class="auth-footer">
    © 2026 Sistem Pengaduan Masyarakat. Semua hak dilindungi.
</div>
@endsection
