@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="text-center max-w-md w-full px-6">
        <div class="w-12 h-12 rounded-xl bg-slate-900 text-white grid place-items-center mx-auto mb-4">
            <i data-feather="shield-off" class="w-6 h-6"></i>
        </div>
        <h1 class="text-3xl font-semibold tracking-tight text-slate-900">403</h1>
        <h2 class="text-sm font-semibold text-slate-700 mt-1">Akses Ditolak</h2>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="inline-flex items-center justify-center mt-6 px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">
            Kembali ke {{ auth()->check() ? 'Dashboard' : 'Login' }}
        </a>
    </div>
</div>
@endsection
