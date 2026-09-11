@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">{{ $pengaduan->exists ? 'Edit Pengaduan' : 'Buat Pengaduan' }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $pengaduan->exists ? 'Perbarui rincian pengaduan.' : 'Isi formulir laporan pengaduan Anda.' }}</p>
        </div>
        <a href="{{ route('pengaduans.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">
        <form method="POST" enctype="multipart/form-data" action="{{ $pengaduan->exists ? route('pengaduans.update', $pengaduan) : route('pengaduans.store') }}" class="space-y-5">
            @csrf
            @if($pengaduan->exists)
                @method('PUT')
            @endif

            @if(auth()->user()->isAdmin() && !$pengaduan->exists)
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Pengadu</label>
                <select name="user_id" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('user_id') border-red-300 @enderror">
                    @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} — {{ $u->email }}</option>
                    @endforeach
                </select>
                @error('user_id')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Telepon</label>
                    <input name="nomor_telepon" type="tel" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('nomor_telepon') border-red-300 @enderror" value="{{ old('nomor_telepon', $pengaduan->nomor_telepon ?: auth()->user()->phone) }}" required>
                    @error('nomor_telepon')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input name="email" type="email" class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('email') border-red-300 @enderror" value="{{ old('email', $pengaduan->email ?: auth()->user()->email) }}" required>
                    @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Isi Pengaduan</label>
                <textarea name="isi_pengaduan" rows="5" class="w-full px-3.5 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition resize-y @error('isi_pengaduan') border-red-300 @enderror" placeholder="Tuliskan detail keluhan atau aduan Anda..." required>{{ old('isi_pengaduan', $pengaduan->isi_pengaduan) }}</textarea>
                @error('isi_pengaduan')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">
                    Foto Bukti
                    <span class="font-normal text-slate-400 ml-1">— opsional (JPG/PNG/WEBP, maks. 2MB)</span>
                </label>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp,image/*"
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-800 hover:file:bg-slate-200 border border-slate-200 rounded-xl bg-white p-1.5">
                @error('foto')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror

                @if($pengaduan->foto)
                <div class="mt-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-xs font-medium text-slate-500 mb-2">Foto saat ini:</p>
                    <a href="{{ Storage::url($pengaduan->foto) }}" target="_blank" class="inline-block">
                        <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto pengaduan" class="rounded-lg border border-slate-200 max-h-40 object-contain">
                    </a>
                </div>
                @endif
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 transition">
                    Simpan
                </button>
                <a href="{{ route('pengaduans.index') }}" class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
