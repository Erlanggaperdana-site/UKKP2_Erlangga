<nav id="sidebar" class="w-64 bg-slate-900 text-slate-100 flex flex-col fixed inset-y-0 left-0 z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out border-r border-slate-800">
    {{-- Brand --}}
    <div class="flex items-center gap-3 h-16 px-6 border-b border-slate-800 shrink-0">
        <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-600/20 shrink-0">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <h1 class="text-[15px] font-bold tracking-tight leading-none">SPM</h1>
            <p class="text-[11px] text-slate-400 font-medium tracking-wide">Pengaduan Masyarakat</p>
        </div>
        <button id="sidebar-close-btn" class="md:hidden w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <div class="flex-1 overflow-y-auto py-5 px-3">
        @php
            $menuItems = [];
            if (auth()->user()->isAdmin()) {
                $menuItems = [
                    ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'],
                    ['label' => 'Manajemen User', 'route' => 'users.index', 'icon' => 'users'],
                    ['label' => 'Daftar Pengaduan', 'route' => 'pengaduans.index', 'icon' => 'document-text'],
                ];
            } elseif (auth()->user()->isPetugas()) {
                $menuItems = [
                    ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'],
                    ['label' => 'Daftar Pengaduan', 'route' => 'pengaduans.index', 'icon' => 'document-text'],
                ];
            } else {
                $menuItems = [
                    ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'],
                    ['label' => 'Pengaduan Saya', 'route' => 'pengaduans.index', 'icon' => 'document-text'],
                    ['label' => 'Buat Pengaduan', 'route' => 'pengaduans.create', 'icon' => 'plus-circle'],
                ];
            }
        @endphp

        <p class="px-3 mb-3 text-[11px] font-semibold tracking-widest text-slate-500 uppercase">Menu</p>
        <div class="space-y-1">
            @foreach ($menuItems as $item)
                @php $isActive = request()->routeIs($item['route'] . '*'); @endphp
                <a href="{{ route($item['route']) }}"
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ $isActive ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white hover:bg-white/[0.06]' }}">
                    {{-- Icon --}}
                    @if($item['icon'] === 'home')
                        <svg class="w-[18px] h-[18px] shrink-0 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    @elseif($item['icon'] === 'users')
                        <svg class="w-[18px] h-[18px] shrink-0 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    @elseif($item['icon'] === 'document-text')
                        <svg class="w-[18px] h-[18px] shrink-0 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    @elseif($item['icon'] === 'plus-circle')
                        <svg class="w-[18px] h-[18px] shrink-0 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                    <span class="flex-1 truncate">{{ $item['label'] }}</span>
                    @if ($isActive)
                        <span class="w-1.5 h-1.5 rounded-full bg-white/80 shrink-0"></span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    {{-- User / Logout --}}
    <div class="border-t border-slate-800 p-3 space-y-3 bg-slate-900">
        <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition-colors group">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white text-sm font-bold shrink-0 shadow-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0 text-left">
                <div class="text-sm font-semibold text-white truncate leading-none group-hover:text-white">{{ auth()->user()->name }}</div>
                <div class="text-xs text-slate-400 truncate capitalize">{{ auth()->user()->role }}</div>
            </div>
            <svg class="w-4 h-4 text-slate-500 group-hover:text-slate-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-red-300 hover:bg-red-500/10 transition-colors">
                <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</nav>

<div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm md:hidden opacity-0 pointer-events-none transition-opacity duration-300 z-30"></div>
