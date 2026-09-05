@extends('layouts.app')
@section('header', 'Detail Pengaduan')
@section('content')
<div style="max-width: 960px;">
    <div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">Detail Pengaduan</h1>
            <p class="page-subtitle mt-2">
                <span class="code-badge">{{ $pengaduan->nomor_pengaduan }}</span>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('pengaduans.index') }}" class="btn btn-light">
                Kembali
            </a>
            @can('update', $pengaduan)
            <a href="{{ route('pengaduans.edit', $pengaduan) }}" class="btn btn-primary">
                Edit
            </a>
            @endcan
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="detail-card">
                <div class="card-header">
                    Informasi Pengaduan
                </div>

                <div class="detail-body">
                    <div class="detail-item border-bottom-0 pb-0">
                        <div class="detail-item-label">Pengadu</div>
                        <div class="detail-item-value fs-5 fw-bold">{{ $pengaduan->user->name }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-item-label">Email / Telepon</div>
                        <div class="detail-item-value">{{ $pengaduan->email }} <span class="text-muted mx-1">&middot;</span> {{ $pengaduan->nomor_telepon }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-item-label mb-2">Isi Pengaduan</div>
                        <div class="p-3 bg-light rounded border">
                            <p class="mb-0 text-dark" style="white-space: pre-wrap;">{{ $pengaduan->isi_pengaduan }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-item-label mb-2">Foto Bukti</div>
                        @if($pengaduan->foto)
                        <a href="{{ Storage::url($pengaduan->foto) }}" target="_blank" class="d-inline-block">
                            <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto pengaduan" class="rounded border" style="max-height: 300px; object-fit: contain;">
                        </a>
                        @else
                        <p class="text-muted fst-italic mb-0">Tidak ada foto</p>
                        @endif
                    </div>
                </div>

                @can('delete', $pengaduan)
                <div class="card-body border-top bg-light">
                    <form method="POST" action="{{ route('pengaduans.destroy', $pengaduan) }}" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Hapus Pengaduan
                        </button>
                    </form>
                </div>
                @endcan
            </div>
        </div>

        <div class="col-lg-4">
            <div class="detail-card">
                <div class="card-header">
                    Informasi Tambahan
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="detail-item-label">No. Pengaduan</div>
                        <span class="code-badge mt-1">{{ $pengaduan->nomor_pengaduan }}</span>
                    </div>

                    <div class="mb-4">
                        <div class="detail-item-label">Dibuat</div>
                        <div class="fw-medium text-dark">{{ $pengaduan->created_at->format('d M Y') }}</div>
                        <div class="text-muted" style="font-size: 12px;">{{ $pengaduan->created_at->diffForHumans() }}</div>
                    </div>

                    <div>
                        <div class="detail-item-label">Diperbarui</div>
                        <div class="fw-medium text-dark">{{ $pengaduan->updated_at->format('d M Y') }}</div>
                        <div class="text-muted" style="font-size: 12px;">{{ $pengaduan->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
