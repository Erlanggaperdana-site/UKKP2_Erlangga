@extends('layouts.app')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Selamat datang kembali</h1>
    <p class="text-sm text-slate-500 mt-1">Ringkasan aktivitas sistem pengaduan.</p>
</div>

@php
$cards = [
    ['label' => 'Total User', 'value' => $stats['users'], 'icon' => 'users'],
    ['label' => 'Customer',   'value' => $stats['customers'], 'icon' => 'user-check'],
    ['label' => 'Petugas',    'value' => $stats['petugas'], 'icon' => 'briefcase'],
    ['label' => 'Admin',      'value' => $stats['admins'], 'icon' => 'shield'],
    ['label' => 'Pengaduan',  'value' => $stats['pengaduans'], 'icon' => 'inbox'],
];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @foreach($cards as $c)
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="text-xs font-medium tracking-wide uppercase text-slate-500">{{ $c['label'] }}</div>
                <div class="text-2xl font-semibold tracking-tight text-slate-900 mt-2">{{ $c['value'] }}</div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-slate-900 text-white grid place-items-center shrink-0">
                <i data-feather="{{ $c['icon'] }}" class="w-4 h-4"></i>
            </div>
        </div>
    </div>
    @endforeach
</div>

@include('dashboard.recent')
@endsection
