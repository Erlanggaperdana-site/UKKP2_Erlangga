@extends('layouts.app')
@section('header', auth()->user()->isCustomer() ? 'Pengaduan Saya' : 'Daftar Pengaduan')
@section('content')
<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
        <h1 class="page-title">{{ auth()->user()->isCustomer() ? 'Pengaduan Saya' : 'Daftar Pengaduan' }}</h1>
        <p class="page-subtitle">{{ auth()->user()->isCustomer() ? 'Kelola pengaduan Anda' : 'Pantau semua pengaduan yang masuk' }}</p>
    </div>
    @can('create', App\Models\Pengaduan::class)
    <a href="{{ route('pengaduans.create') }}" class="btn btn-primary d-flex align-items-center">
        <i class="bi bi-plus-lg me-2"></i>Buat Pengaduan
    </a>
    @endcan
</div>

<div class="content-card">
    <div class="card-body border-bottom bg-light">
        <form method="GET" action="{{ route('pengaduans.index') }}" class="row g-3 align-items-end">
            <div class="col-sm-4 col-lg-3">
                <label class="form-label">Cari</label>
                <input type="text" name="search" class="form-control" placeholder="Nomor pengaduan / nama" value="{{ request('search') }}">
            </div>

            <div class="col-sm-4 col-lg-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>

            <div class="col-auto d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
                @if(request('search') || request('date'))
                <a href="{{ route('pengaduans.index') }}" class="btn btn-light">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    @include('pengaduans.table')

    <div class="card-body bg-light border-top py-3 px-4">
        {{ $pengaduans->links() }}
    </div>
</div>
@endsection
