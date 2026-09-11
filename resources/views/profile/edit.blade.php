@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Edit Profil</h1>
            <p class="text-sm text-slate-500 mt-1">Perbarui informasi akun Anda.</p>
        </div>
        <a href="{{ route('profile.show') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                <input name="name" id="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                    class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('name') border-red-300 @enderror">
                @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                <input name="email" id="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                    class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('email') border-red-300 @enderror">
                @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Telepon</label>
                <input name="phone" id="phone" type="tel" value="{{ old('phone', auth()->user()->phone) }}"
                    placeholder="08xxxxxxxxxx"
                    class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 @error('phone') border-red-300 @enderror">
                @error('phone')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 transition">Simpan Perubahan</button>
                <a href="{{ route('profile.show') }}" class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
