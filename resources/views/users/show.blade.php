@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Detail User</h1>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap pengguna.</p>
        </div>
        <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="px-6 sm:px-8 py-6 border-b border-slate-200 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-slate-900 text-white grid place-items-center font-semibold shrink-0">{{ strtoupper(substr($user->name,0,1)) }}</div>
            <div class="min-w-0">
                <div class="text-base font-semibold text-slate-900 truncate">{{ $user->name }}</div>
                <div class="flex items-center gap-2 mt-1 flex-wrap">
                    @if($user->role === 'admin')
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">Admin</span>
                    @elseif($user->role === 'petugas')
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">Petugas</span>
                    @else
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">Customer</span>
                    @endif
                    <span class="text-xs text-slate-500 font-mono">#{{ str_pad($user->id,4,'0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-8">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-4">
                    <dt class="text-xs font-medium tracking-wide uppercase text-slate-500">Email</dt>
                    <dd class="text-sm font-medium text-slate-900 mt-1 break-all">{{ $user->email }}</dd>
                </div>
                <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-4">
                    <dt class="text-xs font-medium tracking-wide uppercase text-slate-500">Telepon</dt>
                    <dd class="text-sm font-medium text-slate-900 mt-1">{{ $user->phone ?: '—' }}</dd>
                </div>
                <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-4">
                    <dt class="text-xs font-medium tracking-wide uppercase text-slate-500">Role</dt>
                    <dd class="mt-2">
                        @if($user->role === 'admin')
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">Admin</span>
                        @elseif($user->role === 'petugas')
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">Petugas</span>
                        @else
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">Customer</span>
                        @endif
                    </dd>
                </div>
                <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-4">
                    <dt class="text-xs font-medium tracking-wide uppercase text-slate-500">Bergabung</dt>
                    <dd class="text-sm font-medium text-slate-900 mt-1">{{ $user->created_at->format('d M Y — H:i') }}</dd>
                    <dd class="text-xs text-slate-500">{{ $user->created_at->diffForHumans() }}</dd>
                </div>
            </dl>
        </div>

        <div class="px-6 sm:px-8 py-4 bg-slate-50/50 border-t border-slate-200 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">
                <i data-feather="edit-2" class="w-4 h-4"></i> Edit User
            </a>
            <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini secara permanen?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-red-200 text-sm font-medium text-red-700 hover:bg-red-50 transition">
                    <i data-feather="trash-2" class="w-4 h-4"></i> Hapus User
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
