@extends('layouts.app')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">{{ auth()->user()->isCustomer() ? 'Pengaduan Saya' : 'Daftar Pengaduan' }}</h1>
        <p class="text-sm text-slate-500 mt-1">{{ auth()->user()->isCustomer() ? 'Kelola pengaduan yang Anda ajukan.' : 'Pantau semua pengaduan yang masuk.' }}</p>
    </div>
    @can('create', App\Models\Pengaduan::class)
    <a href="{{ route('pengaduans.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">
        <i data-feather="plus" class="w-4 h-4"></i> Buat Pengaduan
    </a>
    @endcan
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
    <div class="p-4 sm:p-5 border-b border-slate-200 bg-slate-50/50">
        <form method="GET" action="{{ route('pengaduans.index') }}" class="flex flex-col lg:flex-row gap-3 lg:items-end">
            <div class="flex-1 min-w-0">
                <label class="block text-xs font-medium text-slate-600 mb-1.5">Cari</label>
                <div class="relative">
                    <i data-feather="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nomor pengaduan / nama pengadu"
                        class="w-full pl-9 pr-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900">
                </div>
            </div>
            <div class="w-full lg:w-48">
                <label class="block text-xs font-medium text-slate-600 mb-1.5">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                    class="w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900">
            </div>
            <div class="flex gap-2 lg:shrink-0">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">Cari</button>
                @if(request('search') || request('date'))
                <a href="{{ route('pengaduans.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Reset</a>
                @endif
            </div>
        </form>
    </div>

    @include('pengaduans.table')

    @if(method_exists($pengaduans, 'hasPages') && $pengaduans->hasPages())
    <div class="px-4 py-3 border-t border-slate-200 bg-white">
        {{ $pengaduans->links() }}
    </div>
    @elseif(isset($pengaduans) && method_exists($pengaduans, 'links'))
    <div class="px-4 py-3 border-t border-slate-200 bg-white">
        {{ $pengaduans->links() }}
    </div>
    @endif
</div>
@endsection
