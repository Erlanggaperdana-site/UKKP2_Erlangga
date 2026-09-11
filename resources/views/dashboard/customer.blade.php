@extends('layouts.app')
@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Dashboard Customer</h1>
        <p class="text-sm text-slate-500 mt-1">Pantau status pengaduan layanan restoran Anda.</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 p-6 mb-6 shadow-sm">
    <div class="flex items-start justify-between gap-6">
        <div>
            <div class="text-xs font-semibold tracking-wider uppercase text-slate-500">Total Pengaduan Saya</div>
            <div class="text-3xl font-semibold tracking-tight text-slate-900 mt-2">{{ $total }}</div>
            <div class="text-xs text-slate-500 mt-1">Pengaduan & masukan restoran yang telah Anda kirimkan</div>
        </div>
        <div class="w-10 h-10 rounded-xl bg-slate-900 text-white grid place-items-center shrink-0">
            <i data-feather="inbox" class="w-5 h-5"></i>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-slate-900">Pengaduan Saya Terbaru</h3>
        <a href="{{ route('pengaduans.index') }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">Lihat semua →</a>
    </div>
    @include('pengaduans.table', ['pengaduans' => $pengaduans, 'simple' => true])
</div>
@endsection
