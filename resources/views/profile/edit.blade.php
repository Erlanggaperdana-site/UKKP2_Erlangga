@extends('layouts.app')
@section('header', 'Edit Profil')
@section('content')
<div style="max-width: 720px;">
    <div class="page-header mb-4">
        <h1 class="page-title">Edit Profil</h1>
        <p class="page-subtitle">Perbarui informasi akun Anda</p>
    </div>

    <div class="content-card">
        <form method="POST" action="{{ route('profile.update') }}" class="card-body p-4 p-md-5">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Nomor Telepon</label>
                    <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}">
                    @error('phone')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top mt-4">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="{{ route('profile.show') }}" class="btn btn-light">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
