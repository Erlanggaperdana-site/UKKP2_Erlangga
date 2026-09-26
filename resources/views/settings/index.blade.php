@extends('layouts.app')
@section('content')
@php
    $user = auth()->user();
    $settings = array_merge(\App\Models\User::defaultSettings(), $user->settings ?? []);

    $colorMap = [
        'slate'  => '#475569',
        'blue'   => '#2563eb',
        'green'  => '#16a34a',
        'purple' => '#9333ea',
        'rose'   => '#e11d48',
        'orange' => '#ea580c',
    ];
@endphp

<div class="max-w-3xl mx-auto" x-data="settingsPage()">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Pengaturan</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola profil, password, dan tampilan aplikasi Anda.</p>
    </div>

    <div class="flex gap-1 p-1 bg-slate-100 rounded-xl mb-6">
        <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
            <i data-feather="user" class="w-4 h-4"></i> Profil
        </button>
        <button @click="activeTab = 'password'" :class="activeTab === 'password' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
            <i data-feather="lock" class="w-4 h-4"></i> Password
        </button>
        <button @click="activeTab = 'appearance'" :class="activeTab === 'appearance' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
            <i data-feather="palette" class="w-4 h-4"></i> Tampilan
        </button>
    </div>

    {{-- Tab: Profil --}}
    <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        {{-- Avatar Card --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden mb-4">
            <div class="px-6 sm:px-8 py-5 border-b border-slate-200">
                <h2 class="text-base font-semibold text-slate-900">Foto Profil</h2>
                <p class="text-sm text-slate-500 mt-0.5">Unggah atau hapus foto profil Anda.</p>
            </div>
            <div class="px-6 sm:px-8 py-6" x-data="{ uploading: false }">
                <div class="flex items-center gap-5">
                    <div class="shrink-0">
                        @if($user->hasAvatar())
                            <img src="{{ $user->getAvatarUrl() }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-slate-200 shadow-sm">
                        @else
                            <div class="w-20 h-20 rounded-full text-white grid place-items-center font-bold text-2xl shadow-sm border-2 border-slate-200" style="background:{{ $colorMap[$settings['theme_color']] ?? '#475569' }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <form action="{{ route('settings.avatar.update') }}" method="POST" enctype="multipart/form-data" x-on:submit="uploading = true">
                            @csrf
                            <div class="flex items-center gap-3">
                                <label class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 cursor-pointer transition">
                                    <i data-feather="camera" class="w-4 h-4"></i> Pilih Foto
                                    <input type="file" name="avatar" accept="image/*" class="hidden" x-ref="avatarInput" @change="if($refs.avatarInput.files.length) $el.closest('form').submit()">
                                </label>
                                @if($user->hasAvatar())
                                    <form action="{{ route('settings.avatar.remove') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto profil?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-red-200 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                                            <i data-feather="trash-2" class="w-4 h-4"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                            @error('avatar')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                            <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG, GIF, WebP. Maks 2MB.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Profil --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 sm:px-8 py-5 border-b border-slate-200">
                <h2 class="text-base font-semibold text-slate-900">Informasi Profil</h2>
                <p class="text-sm text-slate-500 mt-0.5">Perbarui informasi akun Anda.</p>
            </div>
            <div class="px-6 sm:px-8 py-6">
                <div class="flex items-center gap-4 mb-6">
                    @if($user->hasAvatar())
                        <img src="{{ $user->getAvatarUrl() }}" alt="Avatar" class="w-14 h-14 rounded-full object-cover border border-slate-200 shrink-0">
                    @else
                        <div class="w-14 h-14 rounded-full text-white grid place-items-center font-semibold text-lg shrink-0" style="background:{{ $colorMap[$settings['theme_color']] ?? '#475569' }}">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <div class="text-base font-semibold text-slate-900 truncate">{{ $user->name }}</div>
                        <div class="text-sm text-slate-500 truncate">{{ $user->email }}</div>
                        <div class="mt-1">
                            @if($user->role === 'admin')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">Admin</span>
                            @elseif($user->role === 'petugas')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">Petugas</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">Customer</span>
                            @endif
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input name="name" id="name" type="text" value="{{ old('name', $user->name) }}" required
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('name') border-red-300 @enderror">
                        @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input name="email" id="email" type="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('email') border-red-300 @enderror">
                        @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Telepon</label>
                        <input name="phone" id="phone" type="tel" value="{{ old('phone', $user->phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 transition @error('phone') border-red-300 @enderror">
                        @error('phone')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                        <button type="submit" class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-white transition" style="background:{{ $colorMap[$settings['theme_color']] ?? '#475569' }}">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tab: Password --}}
    <div x-show="activeTab === 'password'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 sm:px-8 py-5 border-b border-slate-200">
                <h2 class="text-base font-semibold text-slate-900">Ubah Password</h2>
                <p class="text-sm text-slate-500 mt-0.5">Pastikan akun Anda menggunakan password yang kuat.</p>
            </div>
            <div class="px-6 sm:px-8 py-6">
                <form method="POST" action="{{ route('settings.password.update') }}" class="space-y-4">
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
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-medium transition" style="background:{{ $colorMap[$settings['theme_color']] ?? '#475569' }}">
                            <i data-feather="lock" class="w-4 h-4"></i> Perbarui Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tab: Tampilan --}}
    <div x-show="activeTab === 'appearance'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <form method="POST" action="{{ route('settings.appearance.update') }}">
            @csrf
            @method('PUT')

            {{-- Theme Color --}}
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden mb-4">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-200">
                    <h2 class="text-base font-semibold text-slate-900">Warna Tema</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Pilih warna utama untuk tampilan aplikasi.</p>
                </div>
                <div class="px-6 sm:px-8 py-6">
                    <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
                        @foreach(['slate'=>'Slate','blue'=>'Biru','green'=>'Hijau','purple'=>'Ungu','rose'=>'Rose','orange'=>'Oranye'] as $key => $label)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="theme_color" value="{{ $key }}" class="sr-only peer"
                                {{ $settings['theme_color'] === $key ? 'checked' : '' }}
                                x-model="selectedColor">
                            <div class="flex flex-col items-center gap-2 p-3 rounded-xl border-2 transition-all"
                                 :class="selectedColor === '{{ $key }}' ? 'border-slate-900 bg-slate-50' : 'border-transparent hover:bg-slate-50'">
                                <div class="w-10 h-10 rounded-full shadow-sm ring-2 ring-white transition-all"
                                     :class="selectedColor === '{{ $key }}' ? 'ring-2' : ''"
                                     style="background:{{ $colorMap[$key] }}"></div>
                                <span class="text-xs font-medium text-slate-700">{{ $label }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Sidebar Mode --}}
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden mb-4">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-200">
                    <h2 class="text-base font-semibold text-slate-900">Mode Sidebar</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Pilih mode tampilan sidebar.</p>
                </div>
                <div class="px-6 sm:px-8 py-6">
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="sidebar_mode" value="dark" class="sr-only peer"
                                x-model="selectedSidebar">
                            <div class="p-4 rounded-xl border-2 transition-all"
                                 :class="selectedSidebar === 'dark' ? 'border-slate-900 bg-slate-50' : 'border-slate-200 hover:border-slate-300'">
                                <div class="w-full h-20 rounded-lg mb-3 flex items-center justify-center" style="background:#0f172a">
                                    <div class="w-6 h-6 rounded bg-orange-500"></div>
                                </div>
                                <p class="text-sm font-medium text-slate-900 text-center">Gelap</p>
                                <p class="text-xs text-slate-500 text-center mt-0.5">Sidebar warna gelap</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="sidebar_mode" value="light" class="sr-only peer"
                                x-model="selectedSidebar">
                            <div class="p-4 rounded-xl border-2 transition-all"
                                 :class="selectedSidebar === 'light' ? 'border-slate-900 bg-slate-50' : 'border-slate-200 hover:border-slate-300'">
                                <div class="w-full h-20 rounded-lg border border-slate-200 mb-3 flex items-center justify-center" style="background:#ffffff">
                                    <div class="w-6 h-6 rounded bg-orange-500"></div>
                                </div>
                                <p class="text-sm font-medium text-slate-900 text-center">Terang</p>
                                <p class="text-xs text-slate-500 text-center mt-0.5">Sidebar warna terang</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Live Preview --}}
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden mb-4">
                <div class="px-6 sm:px-8 py-5 border-b border-slate-200">
                    <h2 class="text-base font-semibold text-slate-900">Pratinjau Langsung</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Lihat perubahan sebelum disimpan.</p>
                </div>
                <div class="px-6 sm:px-8 py-6">
                    <div class="rounded-xl border overflow-hidden max-w-xs mx-auto shadow-sm"
                         :style="'border-color:' + (selectedSidebar === 'dark' ? '#1e293b' : '#e2e8f0')">
                        {{-- Mini sidebar --}}
                        <div class="p-3 transition-all duration-300"
                             :style="'background:' + (selectedSidebar === 'dark' ? '#0f172a' : '#ffffff')">
                            <div class="flex items-center gap-2 mb-3 px-2">
                                <div class="w-6 h-6 rounded overflow-hidden shrink-0">
                                    <img src="/icon/icon.png" alt="Logo" class="w-full h-full object-cover">
                                </div>
                                <span class="text-xs font-bold transition-colors"
                                      :style="'color:' + (selectedSidebar === 'dark' ? '#ffffff' : '#0f172a')">Pengaduan Restoran</span>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 px-2 py-1.5 rounded text-xs font-semibold transition-all"
                                     :style="(selectedSidebar === 'dark' ? 'background:#fff;color:#0f172a' : 'background:' + colorMap[selectedColor] + '15;color:' + colorMap[selectedColor])">
                                    <div class="w-3 h-3 rounded-sm transition-colors" :style="'background:' + colorMap[selectedColor]"></div>
                                    <span>Dashboard</span>
                                </div>
                                <div class="flex items-center gap-2 px-2 py-1.5 rounded text-xs transition-colors"
                                     :style="'color:' + (selectedSidebar === 'dark' ? '#64748b' : '#94a3b8')">
                                    <div class="w-3 h-3 rounded-sm bg-current opacity-40"></div>
                                    <span>Pengaduan Masuk</span>
                                </div>
                                <div class="flex items-center gap-2 px-2 py-1.5 rounded text-xs transition-colors"
                                     :style="'color:' + (selectedSidebar === 'dark' ? '#64748b' : '#94a3b8')">
                                    <div class="w-3 h-3 rounded-sm bg-current opacity-40"></div>
                                    <span>Profil</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-medium transition"
                        :style="'background:' + colorMap[selectedColor]">
                    <i data-feather="save" class="w-4 h-4"></i> Simpan Tampilan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function settingsPage() {
    const colorMap = {
        'slate': '#475569',
        'blue': '#2563eb',
        'green': '#16a34a',
        'purple': '#9333ea',
        'rose': '#e11d48',
        'orange': '#ea580c'
    };
    return {
        activeTab: '{{ request("tab", "profile") }}',
        selectedColor: '{{ $settings["theme_color"] }}',
        selectedSidebar: '{{ $settings["sidebar_mode"] }}',
        colorMap: colorMap
    }
}
</script>
@endsection
