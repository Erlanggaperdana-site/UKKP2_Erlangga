<nav id="sidebar" class="w-64 bg-slate-900 text-white flex flex-col fixed inset-y-0 left-0 z-40 transform -translate-x-full md:translate-x-0 md:relative transition-transform duration-300 ease-in-out">
    <div class="flex items-center justify-between h-16 px-6 border-b border-slate-700">
        <h1 class="text-xl font-bold">SPM</h1>
        <button id="sidebar-close-btn" class="md:hidden text-slate-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto py-6 px-3 space-y-2">
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

        @foreach ($menuItems as $item)
            @php
                $isActive = request()->routeIs($item['route'] . '*');
                $iconMap = [
                    'home' => 'M3 12a9 9 0 110-18A9 9 0 013 12zm9-7a7 7 0 110 14 7 7 0 010-14zm3.536 5.464a1 1 0 10-1.414-1.414L12 10.586l-1.122-1.122a1 1 0 00-1.414 1.414L10.586 12l-1.122 1.122a1 1 0 001.414 1.414L12 13.414l1.122 1.122a1 1 0 001.414-1.414L13.414 12l1.122-1.122z',
                    'users' => 'M12 4a4 4 0 110 8 4 4 0 010-8zM2 12a1 1 0 011-1h18a1 1 0 011 1v6a1 1 0 01-1 1H3a1 1 0 01-1-1v-6z',
                    'document-text' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'plus-circle' => 'M12 4a8 8 0 110 16 8 8 0 010-16zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zM9 12a1 1 0 011-1h5a1 1 0 110 2h-5a1 1 0 01-1-1z',
                ];
                $icon = $iconMap[$item['icon']] ?? '';
            @endphp

            <a href="{{ route($item['route']) }}" class="flex items-center px-4 py-3 rounded-lg transition-colors {{ $isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="{{ $icon }}" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ $item['label'] }}</span>
                @if ($isActive)
                    <div class="ml-auto w-1 h-6 bg-blue-300 rounded-full"></div>
                @endif
            </a>
        @endforeach
    </div>

    <div class="border-t border-slate-700 p-4">
        <a href="{{ route('profile.show') }}" class="flex items-center px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 mb-2 transition-colors">
            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center mr-3 flex-shrink-0">
                <span class="text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-medium truncate">{{ auth()->user()->name }}</div>
                <div class="text-xs text-slate-500 truncate">{{ auth()->user()->role }}</div>
            </div>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800 transition-colors text-sm">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </button>
        </form>
    </div>
</nav>

<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 md:hidden opacity-0 pointer-events-none transition-opacity z-30"></div>
