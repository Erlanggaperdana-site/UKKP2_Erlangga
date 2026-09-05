@extends('layouts.app')
@section('header', '403 - Akses Ditolak')
@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="text-center">
        <div class="mb-8">
            <svg class="w-32 h-32 mx-auto text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h1 class="text-6xl font-bold text-slate-900 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-slate-900 mb-2">Akses Ditolak</h2>
        <p class="text-slate-600 mb-8">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke {{ auth()->check() ? 'Dashboard' : 'Login' }}
        </a>
    </div>
</div>
@endsection
