@extends('layouts.app')
@section('header', 'Ubah Password')
@section('content')
<div style="max-width: 720px;">
    <div class="page-header mb-4">
        <h1 class="page-title">Ubah Password</h1>
        <p class="page-subtitle">Perbarui password akun Anda untuk keamanan lebih baik</p>
    </div>

    <div class="content-card">
        <form method="POST" action="{{ route('profile.password.update') }}" class="card-body p-4 p-md-5">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Password Lama</label>
                <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')
                <div class="form-text-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Password Baru</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                <div class="form-text-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                @error('password_confirmation')
                <div class="form-text-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 pt-3 border-top mt-4">
                <button type="submit" class="btn btn-primary">
                    Perbarui Password
                </button>
                <a href="{{ route('profile.show') }}" class="btn btn-light">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
