@extends('layouts.app')
@section('header', $pengaduan->exists ? 'Edit Pengaduan' : 'Buat Pengaduan')
@section('content')
<div style="max-width: 720px;">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">{{ $pengaduan->exists ? 'Edit Pengaduan' : 'Buat Pengaduan Baru' }}</h1>
            <p class="page-subtitle">{{ $pengaduan->exists ? 'Perbarui pengaduan Anda' : 'Buat laporan pengaduan' }}</p>
        </div>
        <a href="{{ route('pengaduans.index') }}" class="btn btn-light">
            Kembali
        </a>
    </div>

    <div class="content-card">
        <form method="POST" enctype="multipart/form-data" action="{{ $pengaduan->exists ? route('pengaduans.update', $pengaduan) : route('pengaduans.store') }}" class="card-body p-4 p-md-5">
            @csrf
            @if($pengaduan->exists)
                @method('PUT')
            @endif

            @if(auth()->user()->isAdmin() && !$pengaduan->exists)
            <div class="mb-4">
                <label class="form-label">Pengadu</label>
                <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                    @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} — {{ $u->email }}</option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="form-text-error">{{ $message }}</div>
                @enderror
            </div>
            @endif

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Nomor Telepon</label>
                    <input name="nomor_telepon" type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{ old('nomor_telepon', $pengaduan->nomor_telepon ?: auth()->user()->phone) }}" required>
                    @error('nomor_telepon')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pengaduan->email ?: auth()->user()->email) }}" required>
                    @error('email')
                    <div class="form-text-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Isi Pengaduan</label>
                <textarea name="isi_pengaduan" rows="6" class="form-control @error('isi_pengaduan') is-invalid @enderror" required>{{ old('isi_pengaduan', $pengaduan->isi_pengaduan) }}</textarea>
                @error('isi_pengaduan')
                <div class="form-text-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Foto Bukti
                    <span class="text-muted" style="font-size: 11px; font-weight: normal;">(opsional, JPG/PNG/WEBP maks. 2MB)</span>
                </label>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp,image/*" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                <div class="form-text-error">{{ $message }}</div>
                @enderror

                @if($pengaduan->foto)
                <div class="mt-3 p-3 bg-light rounded border">
                    <p class="form-label mb-2">Foto saat ini:</p>
                    <a href="{{ Storage::url($pengaduan->foto) }}" target="_blank" class="d-inline-block">
                        <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto pengaduan" class="rounded border" style="max-height: 180px; object-fit: contain;">
                    </a>
                </div>
                @endif
            </div>

            <div class="d-flex gap-2 pt-3 border-top mt-4">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="{{ route('pengaduans.index') }}" class="btn btn-light">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
