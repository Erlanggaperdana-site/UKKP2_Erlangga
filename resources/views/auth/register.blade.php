@extends('layouts.app')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-slate-900 text-white mb-4 shadow-sm">
            <i data-feather="coffee" class="w-5 h-5 text-orange-400"></i>
        </div>
        <h1 class="text-[22px] font-semibold tracking-tight text-slate-900">Buat akun</h1>
        <p class="text-sm text-slate-500 mt-1.5">Daftar sebagai pelanggan restoran</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                placeholder="Nama Anda"
                class="block w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('name') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">
            @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                placeholder="nama@email.com"
                class="block w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('email') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">
            @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Telepon <span class="font-normal text-slate-400">— opsional</span></label>
            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}"
                placeholder="08xxxxxxxxxx"
                class="block w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('phone') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">
            @error('phone')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
            <input id="password" name="password" type="password" required placeholder="••••••••"
                class="block w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('password') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">
            @error('password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••"
                class="block w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('password_confirmation') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">
            @error('password_confirmation')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <button type="submit"
            class="w-full inline-flex justify-center items-center py-2.5 px-4 rounded-xl text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 shadow-sm transition">
            Daftar
        </button>
    </form>

    <p class="text-sm text-center text-slate-600 mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-medium text-slate-900 underline underline-offset-4 decoration-slate-200 hover:decoration-slate-400 transition">Masuk</a>
    </p>
</div>
<p class="text-center text-xs text-slate-400 mt-8">© {{ date('Y') }}  Pengaduan Restoran</p>
@endsection
