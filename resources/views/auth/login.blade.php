@extends('layouts.app')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-slate-900 text-white mb-4 shadow-sm">
            <i data-feather="coffee" class="w-5 h-5 text-orange-400"></i>
        </div>
        <h1 class="text-[22px] font-semibold tracking-tight text-slate-900">Selamat datang</h1>
        <p class="text-sm text-slate-500 mt-1.5">Masuk ke Dashboard — Pengaduan Restoran</p>
    </div>

    <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                placeholder="nama@email.com"
                class="block w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('email') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">
            @error('email')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
            <input id="password" name="password" type="password" required
                class="block w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('password') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">
            @error('password')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-2 py-1 cursor-pointer select-none">
            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
            <span class="text-sm text-slate-600">Ingat saya</span>
        </label>

        <button type="submit"
            class="w-full inline-flex justify-center items-center py-2.5 px-4 rounded-xl text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 shadow-sm transition">
            Masuk
        </button>
    </form>

    <p class="text-sm text-center text-slate-600 mt-6">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-medium text-slate-900 hover:text-slate-700 underline underline-offset-4 decoration-slate-200 hover:decoration-slate-400 transition">Daftar sebagai pelanggan</a>
    </p>
</div>

<p class="text-center text-xs text-slate-400 mt-8">© {{ date('Y') }}  Pengaduan Restoran</p>
@endsection
