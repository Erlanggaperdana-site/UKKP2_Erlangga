@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Dashboard Petugas</h1>
    <p class="text-sm text-slate-500 mt-1">Pantau dan kelola pengaduan pelanggan restoran yang masuk.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8 w-full">
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:border-slate-300 transition">
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="text-xs font-semibold tracking-wider uppercase text-slate-500">Total Pengaduan Masuk</div>
                <div class="text-3xl font-bold tracking-tight text-slate-900 mt-2">{{ $stats['pengaduans'] }}</div>
                <p class="text-xs text-slate-400 mt-1">Pengaduan dari pelanggan restoran yang perlu ditindaklanjuti</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-slate-900 text-white grid place-items-center shrink-0 shadow-sm">
                <i data-feather="inbox" class="w-5 h-5"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:border-slate-300 transition">
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="text-xs font-semibold tracking-wider uppercase text-slate-500">Total Pelanggan (Customer)</div>
                <div class="text-3xl font-bold tracking-tight text-slate-900 mt-2">{{ $stats['customers'] }}</div>
                <p class="text-xs text-slate-400 mt-1">Pelanggan terdaftar yang dapat mengajukan pengaduan</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-orange-50 border border-orange-100 text-orange-600 grid place-items-center shrink-0 shadow-sm">
                <i data-feather="users" class="w-5 h-5"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-semibold text-slate-900">Pengaduan Masuk Terbaru</h3>
            <p class="text-xs text-slate-500 mt-0.5">Daftar pengaduan terkini dari pelanggan restoran</p>
        </div>
        <a href="{{ route('pengaduans.index') }}" class="text-xs font-medium text-slate-600 hover:text-slate-900 flex items-center gap-1">
            Lihat Semua Pengaduan →
        </a>
    </div>
    @include('pengaduans.table', ['pengaduans' => $pengaduans, 'simple' => true])
</div>
@endsection
