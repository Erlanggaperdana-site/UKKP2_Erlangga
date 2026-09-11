@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">{{ $user->exists ? 'Edit User' : 'Tambah User' }}</h1>
            <p class="text-sm text-slate-500 mt-1">
                @if(auth()->user()->isPetugas())
                    Tambah data customer baru untuk pelayanan restoran.
                @else
                    {{ $user->exists ? 'Perbarui informasi pengguna.' : 'Buat akun pengguna baru.' }}
                @endif
            </p>
        </div>
        <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">
        <form method="POST" action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" class="space-y-5">
            @csrf
            @if($user->exists) @method('PUT') @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input name="name" type="text" value="{{ old('name', $user->name) }}" required placeholder="Nama lengkap customer"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('name') border-red-300 @enderror">
                    @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                    @if(auth()->user()->isPetugas())
                        <input type="hidden" name="role" value="customer">
                        <input type="text" value="Customer" readonly disabled class="w-full px-3.5 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-sm text-slate-600 cursor-not-allowed font-medium">
                        <p class="mt-1 text-xs text-slate-400">Petugas hanya dapat menambahkan user dengan role Customer.</p>
                    @else
                        <select name="role" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('role') border-red-300 @enderror">
                            @foreach($roles as $role)
                            <option value="{{ $role }}" @selected(old('role', $user->role ?: 'customer') === $role)>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                        @error('role')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input name="email" type="email" value="{{ old('email', $user->email) }}" required placeholder="nama@email.com"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('email') border-red-300 @enderror">
                    @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Telepon</label>
                    <input name="phone" type="tel" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('phone') border-red-300 @enderror">
                    @error('phone')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Password @if(!$user->exists)<span class="text-red-500">*</span>@endif
                        @if($user->exists)<span class="font-normal text-slate-400"> — kosongkan jika tidak diubah</span>@endif
                    </label>
                    <input name="password" type="password" {{ !$user->exists ? 'required' : '' }} placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('password') border-red-300 @enderror">
                    @error('password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password @if(!$user->exists)<span class="text-red-500">*</span>@endif</label>
                    <input name="password_confirmation" type="password" {{ !$user->exists ? 'required' : '' }} placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900">
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 transition">
                    {{ $user->exists ? 'Simpan Perubahan' : 'Buat User' }}
                </button>
                <a href="{{ route('users.index') }}" class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
