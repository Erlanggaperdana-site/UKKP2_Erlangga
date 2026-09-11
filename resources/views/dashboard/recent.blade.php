<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-900">Pengaduan Terbaru</h3>
            </div>
            @include('pengaduans.table')
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-900">User Terbaru</h3>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse($users as $user)
                <li class="flex items-center justify-between gap-3 px-5 py-4">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-slate-900 text-white grid place-items-center text-xs font-semibold shrink-0">{{ strtoupper(substr($user->name,0,1)) }}</div>
                        <div class="min-w-0">
                            <div class="text-sm font-medium text-slate-900 truncate">{{ $user->name }}</div>
                            <div class="text-xs text-slate-500 truncate">{{ $user->email }}</div>
                        </div>
                    </div>
                    <span class="shrink-0 inline-flex px-2.5 py-1 rounded-full text-xs font-medium border @if($user->role==='admin') bg-red-50 text-red-700 border-red-100 @elseif($user->role==='petugas') bg-amber-50 text-amber-700 border-amber-100 @else bg-emerald-50 text-emerald-700 border-emerald-100 @endif">{{ ucfirst($user->role) }}</span>
                </li>
                @empty
                <li class="px-6 py-10 text-center">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-400 grid place-items-center mx-auto mb-3"><i data-feather="users" class="w-4 h-4"></i></div>
                    <p class="text-sm text-slate-500">Belum ada data user</p>
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
