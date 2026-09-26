<!doctype html>
<html lang="id" class="antialiased text-slate-800 bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="RestoAduan — Pengaduan Pelanggan Restoran, sampaikan keluhan & masukan antar pelanggan dengan cepat">
    <title>{{ config('app.name', 'Pengaduan Restoran') }}</title>
    <link rel="icon" type="image/png" href="/icon/icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '{{ $tc["50"] }}',
                            100: '{{ $tc["100"] }}',
                            200: '{{ $tc["200"] }}',
                            500: '{{ $tc["500"] }}',
                            600: '{{ $tc["600"] }}',
                            700: '{{ $tc["700"] }}',
                        }
                    }
                }
            }
        }
    </script>

    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        :root {
            --c-50: {{ $tc["50"] }};
            --c-100: {{ $tc["100"] }};
            --c-200: {{ $tc["200"] }};
            --c-500: {{ $tc["500"] }};
            --c-600: {{ $tc["600"] }};
            --c-700: {{ $tc["700"] }};
            --sb-hover-bg: {{ $sidebarMode === 'dark' ? 'rgba(30,41,59,0.8)' : '#f1f5f9' }};
            --sb-hover-text: {{ $sidebarMode === 'dark' ? '#f8fafc' : '#0f172a' }};
        }
        @keyframes slideInRight { from { opacity:0; transform: translateX(20px); } to { opacity:1; transform: translateX(0); } }
        @keyframes scaleIn { from { opacity:0; transform: scale(0.96); } to { opacity:1; transform: scale(1); } }
        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(200%); } }
        .animate-slide-in { animation: slideInRight 0.55s cubic-bezier(0.16,1,0.3,1) both; }
        .animate-scale-in { animation: scaleIn 0.35s cubic-bezier(0.16,1,0.3,1) both; }
        #page-loader { position: fixed; top:0; left:0; height:2px; width:0%; background:#0f172a; z-index:9999; pointer-events:none; transition: width 0.55s cubic-bezier(0.16,1,0.3,1), opacity 0.45s cubic-bezier(0.16,1,0.3,1); opacity:1; will-change: width, opacity; }
        #page-loader::after { content:''; position:absolute; inset:0; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.55), transparent); transform: translateX(-100%); animation: shimmer 1.25s ease-in-out infinite; }
        #page-loader.done { opacity:0; }
        #page-overlay { transition: opacity 0.5s cubic-bezier(0.16,1,0.3,1); will-change: opacity; }
        #page-overlay .overlay-card { transition: transform 0.5s cubic-bezier(0.16,1,0.3,1), opacity 0.5s cubic-bezier(0.16,1,0.3,1); will-change: transform, opacity; }
        #page-overlay-bar { animation: shimmer 1.4s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) {
            .animate-slide-in, .animate-scale-in { animation: none !important; }
            #page-loader, #page-overlay, #page-overlay .overlay-card { transition: none !important; }
            #page-loader::after, #page-overlay-bar { animation: none !important; }
        }

        .btn-primary { background: var(--c-600); color: #fff; }
        .btn-primary:hover { background: var(--c-700); }
        .sidebar-link-active { background: var(--c-100); color: var(--c-700); }
        .sidebar-link-active-dark { background: #fff; color: #0f172a; }
        .accent-text { color: var(--c-600); }
        .accent-bg { background: var(--c-600); }
        .loader-bar { background: var(--c-600); }

        .sb-link {
            transition: background 0.15s, color 0.15s;
        }
        .sb-link:hover {
            background: var(--sb-hover-bg) !important;
            color: var(--sb-hover-text) !important;
        }
        .sb-link:hover i {
            color: var(--sb-hover-text) !important;
        }
        .sb-icon-btn {
            transition: background 0.15s, color 0.15s;
        }
        .sb-icon-btn:hover {
            background: var(--sb-hover-bg) !important;
            color: var(--sb-hover-text) !important;
        }
    </style>
</head>
<body class="font-sans antialiased text-sm bg-slate-50 min-h-screen flex flex-col">
    <div id="page-loader" aria-hidden="true"></div>
    <div id="page-overlay" class="fixed inset-0 z-9998 bg-white/75 backdrop-blur-[3px] flex items-center justify-center opacity-100" aria-hidden="true">
        <div class="overlay-card bg-white rounded-2xl border border-slate-200 shadow-xl shadow-slate-900/[0.07] px-5 py-4 flex items-center gap-4 min-w-65 max-w-[90vw]">
            <div class="w-10 h-10 rounded-xl overflow-hidden shrink-0 shadow-sm">
                <img src="/icon/icon.png" alt="Logo" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-900 leading-none">Memuat Pengaduan Restoran</p>
                <p class="text-xs text-slate-500 mt-1">Menyiapkan halaman…</p>
                <div class="mt-3 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                    <div id="page-overlay-bar" class="h-full w-2/3 rounded-full loader-bar"></div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.alert')

    @auth
    @php
        $isDarkSidebar = $sidebarMode === 'dark';
        $sbBg = $isDarkSidebar ? '#0f172a' : '#ffffff';
        $sbBorder = $isDarkSidebar ? '#1e293b' : '#e2e8f0';
        $sbText = $isDarkSidebar ? '#cbd5e1' : '#475569';
        $sbTextMuted = $isDarkSidebar ? '#64748b' : '#94a3b8';
        $sbHeading = $isDarkSidebar ? '#64748b' : '#94a3b8';
        $sbTitle = $isDarkSidebar ? '#ffffff' : '#0f172a';
        $sbSub = $isDarkSidebar ? '#94a3b8' : '#64748b';
        $sbActiveBg = $isDarkSidebar ? '#ffffff' : $tc['100'];
        $sbActiveText = $isDarkSidebar ? '#0f172a' : $tc['700'];
        $sbActiveIcon = $isDarkSidebar ? '#334155' : $tc['600'];
        $sbHoverBg = $isDarkSidebar ? 'rgba(30,41,59,0.8)' : '#f1f5f9';
        $sbHoverText = $isDarkSidebar ? '#f8fafc' : '#0f172a';
        $sbFooterBorder = $isDarkSidebar ? '#1e293b' : '#e2e8f0';
        $sbIconColor = $isDarkSidebar ? '#64748b' : '#94a3b8';
        $sbActiveShadow = $isDarkSidebar ? '0 1px 3px rgba(0,0,0,0.1)' : '0 1px 3px rgba(0,0,0,0.06)';
    @endphp
    <div x-data="{ sidebarOpen: false, logoutOpen: false }" class="flex h-screen overflow-hidden bg-slate-50">
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-30 w-64 px-4 py-6 overflow-y-auto transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0 border-r flex flex-col"
               style="background:{{ $sbBg }};border-color:{{ $sbBorder }}">
            <div class="flex items-center justify-between mb-8 px-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 rounded-lg overflow-hidden shadow-sm shrink-0">
                        <img src="/icon/icon.png" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <div class="leading-none">
                        <span class="text-sm font-bold tracking-tight block" style="color:{{ $sbTitle }}">Pengaduan Restoran</span>
                        <span class="text-[11px] font-medium tracking-wide" style="color:{{ $sbSub }}">Pengaduan Restoran</span>
                    </div>
                </a>
            </div>

            <nav class="flex-1 space-y-1">
                <p class="px-3 text-xs font-semibold tracking-wider uppercase mb-2 mt-4" style="color:{{ $sbHeading }}">Utama</p>

                @php
                    $routes = [
                        ['route' => 'dashboard',   'name' => 'Dashboard',   'icon' => 'grid',     'is' => request()->routeIs('dashboard')],
                        ['route' => 'users.index',  'name' => auth()->user()->isAdmin() ? 'Manajemen User' : 'Data Customer', 'icon' => 'users',    'is' => request()->routeIs('users.*'), 'hide' => auth()->user()->isCustomer()],
                        ['route' => 'pengaduans.index', 'name' => auth()->user()->isCustomer() ? 'Pengaduan Saya' : 'Pengaduan Masuk', 'icon' => 'inbox', 'is' => request()->routeIs('pengaduans.*')],
                    ];
                @endphp
                @foreach($routes as $r)
                    @if(!($r['hide'] ?? false))
                    <a href="{{ route($r['route']) }}"
                       @if($r['is'])
                           @if($isDarkSidebar)
                               style="background:#fff;color:#0f172a;font-weight:600;box-shadow:0 1px 3px rgba(0,0,0,0.1)"
                           @else
                               style="background:{{ $tc['100'] }};color:{{ $tc['700'] }};font-weight:600"
                           @endif
                       @endif
                       class="sb-link flex items-center gap-3 px-3 py-2 rounded-lg"
                       @unless($r['is'])style="color:{{ $sbText }}"@endunless>
                        <i data-feather="{{ $r['icon'] }}" class="w-4 h-4"
                           style="color:{{ $r['is'] ? ($isDarkSidebar ? '#475569' : $tc['600']) : $sbIconColor }}"></i>
                        <span class="font-medium">{{ $r['name'] }}</span>
                    </a>
                    @endif
                @endforeach
            </nav>

            <div class="pt-4 mt-6 border-t" style="border-color:{{ $sbFooterBorder }}">
                <div class="flex items-center gap-2">
                    <a href="{{ route('settings.index') }}" title="Pengaturan"
                       class="sb-icon-btn flex items-center justify-center w-10 h-10 rounded-xl"
                       style="color:{{ $sbIconColor }}">
                        <i data-feather="settings" class="w-[18px] h-[18px]"></i>
                    </a>
                    <button @click="logoutOpen = true" type="button" title="Keluar"
                            class="sb-icon-btn flex items-center justify-center flex-1 h-10 rounded-xl"
                            style="color:#f87171">
                        <i data-feather="log-out" class="w-[18px] h-[18px]"></i>
                    </button>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="text-slate-500 hover:text-slate-700 focus:outline-none lg:hidden">
                        <i data-feather="menu" class="w-5 h-5"></i>
                    </button>
                    <h2 class="hidden sm:block text-sm font-medium text-slate-500">Pengaduan Pelanggan Restoran</h2>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('settings.index') }}" class="flex items-center gap-3 hover:bg-slate-50 px-3 py-1.5 rounded-full transition-colors border border-transparent hover:border-slate-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-700 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 capitalize leading-tight">{{ auth()->user()->role }}</p>
                        </div>
                        @if(auth()->user()->hasAvatar())
                            <img src="{{ auth()->user()->getAvatarUrl() }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover shadow-sm border border-slate-200">
                        @else
                            <div class="flex items-center justify-center w-8 h-8 rounded-full text-white font-bold text-xs shadow-sm accent-bg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-slate-50 p-4 sm:p-6 lg:p-8">
                <div class="max-w-6xl mx-auto space-y-6">
                    @yield('content')
                </div>
            </main>
        </div>

        {{-- Logout Modal --}}
        <div x-show="logoutOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display:none;">
            <div @click="logoutOpen = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            <div x-show="logoutOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-sm overflow-hidden animate-scale-in">
                <div class="p-6">
                    <div class="w-11 h-11 rounded-xl bg-red-50 border border-red-100 text-red-600 grid place-items-center mb-4">
                        <i data-feather="log-out" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-semibold text-slate-900">Keluar dari akun?</h3>
                    <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">Anda akan keluar dari sesi saat ini dan perlu masuk kembali untuk melanjutkan.</p>
                </div>
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button @click="logoutOpen = false" type="button" class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Batal</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 text-white text-sm font-medium hover:bg-red-700 shadow-sm transition">
                            <i data-feather="log-out" class="w-4 h-4"></i> Ya, Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <main class="min-h-screen flex items-center justify-center p-4 bg-slate-50 sm:bg-slate-100">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>
    @endauth

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        (function(){
            var EASE = 'cubic-bezier(0.16,1,0.3,1)';
            var loader = null, overlay = null;
            function getLoader(){ if(!loader) loader = document.getElementById('page-loader'); return loader; }
            function getOverlay(){ if(!overlay) overlay = document.getElementById('page-overlay'); return overlay; }
            function getOverlayCard(){ var o=getOverlay(); return o ? o.querySelector('.overlay-card') : null; }
            function startLoader(pct){
                var l = getLoader(); if(!l) return;
                l.classList.remove('done');
                l.style.opacity = '1';
                l.style.transition = 'width 0.6s ' + EASE + ', opacity 0.5s ' + EASE;
                void l.offsetWidth;
                l.style.width = pct + '%';
            }
            function showOverlay(){
                var o = getOverlay(); if(!o) return;
                var c = getOverlayCard();
                o.style.display = 'flex';
                if(c){ c.style.opacity='0'; c.style.transform='scale(0.97) translateY(4px)'; }
                void o.offsetWidth;
                o.style.opacity = '1';
                o.style.pointerEvents = 'auto';
                if(c){
                    void c.offsetWidth;
                    c.style.opacity='1';
                    c.style.transform='scale(1) translateY(0)';
                }
            }
            function hideOverlay(){
                var o = getOverlay(); if(!o) return;
                var c = getOverlayCard();
                o.style.opacity = '0';
                o.style.pointerEvents = 'none';
                if(c){ c.style.opacity='0'; c.style.transform='scale(0.98) translateY(4px)'; }
                setTimeout(function(){ if(o.style.opacity === '0') o.style.display = 'none'; }, 520);
            }
            document.addEventListener('DOMContentLoaded', function(){
                feather.replace();
                var l = getLoader();
                if(l) {
                    l.style.transition = 'width 0.6s ' + EASE + ', opacity 0.5s ' + EASE;
                    l.style.width = '70%';
                    setTimeout(function(){
                        l.style.width = '100%';
                        setTimeout(function(){ l.classList.add('done'); }, 350);
                    }, 200);
                }
                setTimeout(function(){ hideOverlay(); }, 600);
            });
            document.addEventListener('alpine:initialized', function(){ feather.replace(); });

            document.addEventListener('click', function(e){
                var a = e.target.closest('a[href]');
                if(!a) return;
                var href = a.getAttribute('href');
                if(!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
                if(a.target === '_blank' || e.ctrlKey || e.metaKey || e.button === 1) return;
                try {
                    var url = new URL(href, window.location.href);
                    if(url.origin !== window.location.origin) return;
                    if(url.pathname === window.location.pathname && url.search === window.location.search && url.hash) return;
                } catch(err) { return; }
                startLoader(45);
                showOverlay();
            }, true);

            document.addEventListener('submit', function(){
                startLoader(60);
                showOverlay();
            }, true);

            window.addEventListener('beforeunload', function(){
                startLoader(40);
                showOverlay();
            });
            window.addEventListener('pageshow', function(e){
                if(!e.persisted) return;
                var l = getLoader(); if(l){ l.classList.add('done'); l.style.width = '0%'; }
                var o = getOverlay(); if(o){ o.style.display = 'none'; o.style.opacity = '0'; o.style.pointerEvents = 'none'; }
                var c = getOverlayCard(); if(c){ c.style.opacity='0'; c.style.transform='scale(0.97) translateY(4px)'; }
            });
        })();
    </script>
</body>
</html>
