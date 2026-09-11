<!doctype html>
<html lang="id" class="antialiased text-slate-800 bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="RestoAduan — Pengaduan Pelanggan Restoran, sampaikan keluhan & masukan antar pelanggan dengan cepat">
    <title>{{ config('app.name', 'Pengaduan Restoran') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>

    {{-- Feather Icons via CDN --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
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
    </style>
</head>
<body class="font-sans antialiased text-sm bg-slate-50 min-h-screen flex flex-col selection:bg-brand-100 selection:text-brand-700">
    {{-- Top Progress Loader (tetap ada) --}}
    <div id="page-loader" aria-hidden="true"></div>
    {{-- Center Screen Loader — modern pill, bukan spinner --}}
    <div id="page-overlay" class="fixed inset-0 z-[9998] bg-white/75 backdrop-blur-[3px] flex items-center justify-center opacity-100" aria-hidden="true">
        <div class="overlay-card bg-white rounded-2xl border border-slate-200 shadow-xl shadow-slate-900/[0.07] px-5 py-4 flex items-center gap-4 min-w-[260px] max-w-[90vw]">
            <div class="w-10 h-10 rounded-xl bg-slate-900 text-white grid place-items-center shrink-0 shadow-sm">
                <i data-feather="coffee" class="w-5 h-5 text-orange-400"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-900 leading-none">Memuat Pengaduan Restoran</p>
                <p class="text-xs text-slate-500 mt-1">Menyiapkan halaman…</p>
                <div class="mt-3 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                    <div id="page-overlay-bar" class="h-full w-2/3 rounded-full bg-slate-900"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Global Toast Alert — selalu di pojok kanan atas viewport --}}
    @include('partials.alert')

    @auth
    <div x-data="{ sidebarOpen: false, logoutOpen: false }" class="flex h-screen overflow-hidden bg-slate-50">
        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 px-4 py-6 overflow-y-auto transition-transform duration-300 bg-slate-900 lg:translate-x-0 lg:static lg:inset-0 border-r border-slate-800 flex flex-col">
            <div class="flex items-center justify-between mb-8 px-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-orange-500 text-white shadow-sm group-hover:bg-orange-400 transition-colors">
                        <i data-feather="coffee" class="w-4 h-4"></i>
                    </div>
                    <div class="leading-none">
                        <span class="text-sm font-bold text-white tracking-tight block">Pengaduan Restoran</span>
                        <span class="text-[11px] font-medium text-slate-400 tracking-wide">Pengaduan Restoran</span>
                    </div>
                </a>
            </div>

            <nav class="flex-1 space-y-1">
                <p class="px-3 text-xs font-semibold tracking-wider text-slate-500 uppercase mb-2 mt-4">Utama</p>

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-white text-slate-900 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-feather="grid" class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-slate-700' : 'text-slate-400' }}"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                @if(!auth()->user()->isCustomer())
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-white text-slate-900 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-feather="users" class="w-4 h-4 {{ request()->routeIs('users.*') ? 'text-slate-700' : 'text-slate-400' }}"></i>
                    <span class="font-medium">{{ auth()->user()->isAdmin() ? 'Manajemen User' : 'Data Customer' }}</span>
                </a>
                @endif

                <a href="{{ route('pengaduans.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('pengaduans.*') ? 'bg-white text-slate-900 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-feather="inbox" class="w-4 h-4 {{ request()->routeIs('pengaduans.*') ? 'text-slate-700' : 'text-slate-400' }}"></i>
                    <span class="font-medium">{{ auth()->user()->isCustomer() ? 'Pengaduan Saya' : 'Pengaduan Masuk' }}</span>
                </a>

                <p class="px-3 text-xs font-semibold tracking-wider text-slate-500 uppercase mb-2 mt-6">Akun</p>

                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('profile.*') ? 'bg-white text-slate-900 font-semibold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-feather="user" class="w-4 h-4 {{ request()->routeIs('profile.*') ? 'text-slate-700' : 'text-slate-400' }}"></i>
                    <span class="font-medium">Profil</span>
                </a>
            </nav>

            <div class="pt-4 mt-6 border-t border-slate-800">
                <button @click="logoutOpen = true" type="button" class="flex items-center w-full gap-3 px-3 py-2.5 rounded-xl text-red-400 hover:text-red-300 hover:bg-red-500/10 border border-transparent hover:border-red-500/20 transition-colors text-left">
                    <span class="w-8 h-8 rounded-lg bg-red-500/15 border border-red-500/20 grid place-items-center shrink-0">
                        <i data-feather="log-out" class="w-4 h-4"></i>
                    </span>
                    <span class="font-semibold text-sm">Keluar</span>
                </button>
            </div>
        </aside>

        {{-- Main Content Wrapper --}}
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            {{-- Topbar --}}
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="text-slate-500 hover:text-slate-700 focus:outline-none lg:hidden">
                        <i data-feather="menu" class="w-5 h-5"></i>
                    </button>
                    <h2 class="hidden sm:block text-sm font-medium text-slate-500">Pengaduan Pelanggan Restoran</h2>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-3 hover:bg-slate-50 px-3 py-1.5 rounded-full transition-colors border border-transparent hover:border-slate-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-700 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 capitalize leading-tight">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-900 text-white font-bold text-xs shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </a>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto bg-slate-50 p-4 sm:p-6 lg:p-8">
                <div class="max-w-6xl mx-auto space-y-6">
                    @yield('content')
                </div>
            </main>
        </div>

        {{-- Logout Confirmation Modal --}}
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
    {{-- Guest / Auth Page --}}
    <main class="min-h-screen flex items-center justify-center p-4 bg-slate-50 sm:bg-slate-100">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>
    @endauth

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Initialize Feather Icons & Loaders — semua easing dibuat extra smooth --}}
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
