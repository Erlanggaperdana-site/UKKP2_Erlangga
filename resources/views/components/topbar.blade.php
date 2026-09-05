<header class="h-16 bg-white border-b border-slate-200 flex items-center px-6 shadow-sm">
    <div class="flex-1 flex items-center">
        <button id="sidebar-toggle" class="md:hidden text-slate-600 hover:text-slate-900 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h2 class="text-xl font-semibold text-slate-900">@yield('header', 'Dashboard')</h2>
    </div>

    <div class="flex items-center space-x-4">
        <div class="hidden sm:flex items-center space-x-3 text-sm">
            <span class="text-slate-600">{{ auth()->user()->name }}</span>
            <span class="inline-block px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </div>

        <div class="flex items-center space-x-2 text-slate-600">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </div>
</header>
