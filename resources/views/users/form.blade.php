@extends('layouts.app')
@section('header', $user->exists ? 'Edit User' : 'Tambah User')
@section('content')
<div style="max-width: 720px;">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">{{ $user->exists ? 'Edit User' : 'Tambah User Baru' }}</h1>
            <p class="page-subtitle">{{ $user->exists ? 'Perbarui informasi user' : 'Buat akun user baru di sistem' }}</p>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-light">
            Kembali
        </a>
    </div>

    <div class="content-card">
        <form method="POST" action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" class="card-body p-4 p-md-5">
            @csrf
            @if($user->exists)
                @method('PUT')
            @endif

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nomor Telepon</label>
                    <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror">
                        @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('role', $user->role ?: 'customer') === $role)>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Password
                        @if($user->exists)
                        <span class="text-muted" style="font-size: 11px; font-weight: normal;">(kosongkan jika tidak diubah)</span>
                        @endif
                    </label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" {{ !$user->exists ? 'required' : '' }}>
                    @error('password')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top mt-4">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-light">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
