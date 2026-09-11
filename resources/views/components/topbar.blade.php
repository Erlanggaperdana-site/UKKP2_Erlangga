<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 z-10 sticky top-0">
    <div class="flex items-center gap-3">
        <button id="sidebar-toggle" class="md:hidden p-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h2 class="text-lg font-bold text-slate-900 tracking-tight">@yield('header', 'Dashboard')</h2>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('profile.show') }}" class="flex items-center gap-3 p-1.5 rounded-full sm:rounded-xl hover:bg-slate-100 transition-colors">
            <div class="hidden sm:block text-right">
                <p class="text-xs font-bold text-slate-900 leading-tight">{{ auth()->user()->name }}</p>
                <p class="text-[11px] text-slate-500 capitalize leading-tight">{{ auth()->user()->role }}</p>
            </div>
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </a>
    </div>
</header>
