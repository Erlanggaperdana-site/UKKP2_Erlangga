@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Detail Pengaduan</h1>
            <div class="mt-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-700 border border-slate-200 font-mono">{{ $pengaduan->nomor_pengaduan }}</span>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('pengaduans.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Kembali</a>
            @can('update', $pengaduan)
            <a href="{{ route('pengaduans.edit', $pengaduan) }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">Edit</a>
            @endcan
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-sm font-semibold text-slate-900">Informasi Pengaduan</h2>
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="px-6 py-5">
                        <div class="text-xs font-medium tracking-wide uppercase text-slate-500 mb-1">Pengadu</div>
                        <div class="text-base font-semibold text-slate-900">{{ $pengaduan->user->name }}</div>
                        <div class="text-sm text-slate-500">{{ $pengaduan->user->email }}</div>
                    </div>
                    <div class="px-6 py-5">
                        <div class="text-xs font-medium tracking-wide uppercase text-slate-500 mb-1">Kontak</div>
                        <div class="text-sm text-slate-700">{{ $pengaduan->email }} <span class="text-slate-300 mx-1">·</span> {{ $pengaduan->nomor_telepon }}</div>
                    </div>
                    <div class="px-6 py-5">
                        <div class="text-xs font-medium tracking-wide uppercase text-slate-500 mb-2">Isi Pengaduan</div>
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-700 whitespace-pre-wrap leading-relaxed m-0">{{ $pengaduan->isi_pengaduan }}</p>
                        </div>
                    </div>
                    <div class="px-6 py-5">
                        <div class="text-xs font-medium tracking-wide uppercase text-slate-500 mb-2">Foto Bukti</div>
                        @if($pengaduan->foto)
                        <a href="{{ Storage::url($pengaduan->foto) }}" target="_blank" class="inline-block">
                            <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto pengaduan" class="rounded-xl border border-slate-200 max-h-72 object-contain">
                        </a>
                        @else
                        <p class="text-sm text-slate-400 m-0">Tidak ada foto</p>
                        @endif
                    </div>
                </div>
                @can('delete', $pengaduan)
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    <form method="POST" action="{{ route('pengaduans.destroy', $pengaduan) }}" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-red-200 text-sm font-medium text-red-700 hover:bg-red-50 transition">
                            <i data-feather="trash-2" class="w-4 h-4"></i> Hapus Pengaduan
                        </button>
                    </form>
                </div>
                @endcan
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-sm font-semibold text-slate-900">Ringkasan</h2>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <div class="text-xs font-medium tracking-wide uppercase text-slate-500 mb-1.5">No. Pengaduan</div>
                        <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-700 border border-slate-200 font-mono">{{ $pengaduan->nomor_pengaduan }}</span>
                    </div>
                    <div>
                        <div class="text-xs font-medium tracking-wide uppercase text-slate-500 mb-1">Dibuat</div>
                        <div class="text-sm font-medium text-slate-900">{{ $pengaduan->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-slate-500">{{ $pengaduan->created_at->diffForHumans() }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium tracking-wide uppercase text-slate-500 mb-1">Diperbarui</div>
                        <div class="text-sm font-medium text-slate-900">{{ $pengaduan->updated_at->format('d M Y') }}</div>
                        <div class="text-xs text-slate-500">{{ $pengaduan->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
