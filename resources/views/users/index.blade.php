@extends('layouts.app')
@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Manajemen User</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola semua pengguna sistem.</p>
    </div>
    <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">
        <i data-feather="plus" class="w-4 h-4"></i> Tambah User
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
    <div class="p-4 sm:p-5 border-b border-slate-200 bg-slate-50/50">
        <form method="GET" action="{{ route('users.index') }}" class="flex flex-col lg:flex-row gap-3 lg:items-end">
            <div class="flex-1 min-w-0">
                <label class="block text-xs font-medium text-slate-600 mb-1.5">Cari</label>
                <div class="relative">
                    <i data-feather="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau email"
                        class="w-full pl-9 pr-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900">
                </div>
            </div>
            <div class="w-full lg:w-48">
                <label class="block text-xs font-medium text-slate-600 mb-1.5">Role</label>
                <select name="role" onchange="this.form.submit()" class="w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900">
                    <option value="">Semua Role</option>
                    @foreach(['admin','petugas','customer'] as $role)
                        @if(auth()->user()->isAdmin() || $role !== 'admin')
                            <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2 lg:shrink-0">
                <button type="submit" class="inline-flex justify-center px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">Filter</button>
                @if(request('search') || request('role'))
                <a href="{{ route('users.index') }}" class="inline-flex justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-y border-slate-200">
                    <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">User</th>
                    <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">Kontak</th>
                    <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">Role</th>
                    <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">Bergabung</th>
                    <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/70 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-900 text-white grid place-items-center text-xs font-semibold shrink-0">{{ strtoupper(substr($user->name,0,1)) }}</div>
                            <div class="min-w-0">
                                <div class="text-sm font-medium text-slate-900 truncate">{{ $user->name }}</div>
                                <div class="text-xs text-slate-500 font-mono">#{{ str_pad($user->id,4,'0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <div class="text-sm text-slate-700">{{ $user->email }}</div>
                        <div class="text-xs text-slate-500">{{ $user->phone ?: '—' }}</div>
                    </td>
                    <td class="px-5 py-4">
                        @if($user->role === 'admin')
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">Admin</span>
                        @elseif($user->role === 'petugas')
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">Petugas</span>
                        @else
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">Customer</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('users.show', $user) }}" class="w-8 h-8 grid place-items-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition" title="Detail"><i data-feather="eye" class="w-4 h-4"></i></a>
                            <a href="{{ route('users.edit', $user) }}" class="w-8 h-8 grid place-items-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition" title="Edit"><i data-feather="edit-2" class="w-4 h-4"></i></a>
                            <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 grid place-items-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition" title="Hapus"><i data-feather="trash-2" class="w-4 h-4"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-14">
                        <div class="flex flex-col items-center text-center max-w-sm mx-auto">
                            <div class="w-10 h-10 rounded-xl bg-slate-900 text-white grid place-items-center mb-3"><i data-feather="users" class="w-5 h-5"></i></div>
                            <h3 class="text-sm font-semibold text-slate-900">Tidak ada data user</h3>
                            <p class="text-sm text-slate-500 mt-1">Coba ubah filter atau tambah user baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="px-4 py-3 border-t border-slate-200 bg-white">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
