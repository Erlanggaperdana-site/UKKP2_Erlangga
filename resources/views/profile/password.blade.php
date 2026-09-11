@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Ubah Password</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui password akun Anda.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">
        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Lama</label>
                <input name="current_password" type="password" required placeholder="Masukkan password lama"
                    class="w-full px-3.5 py-2.5 bg-white border rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('current_password') border-red-300 @else border-slate-200 @enderror">
                @error('current_password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                <input name="password" type="password" required placeholder="Minimal 8 karakter"
                    class="w-full px-3.5 py-2.5 bg-white border rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('password') border-red-300 @else border-slate-200 @enderror">
                @error('password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                <input name="password_confirmation" type="password" required placeholder="Ulangi password baru"
                    class="w-full px-3.5 py-2.5 bg-white border rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('password_confirmation') border-red-300 @else border-slate-200 @enderror">
                @error('password_confirmation')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">
                    <i data-feather="lock" class="w-4 h-4"></i> Perbarui Password
                </button>
                <a href="{{ route('profile.show') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
