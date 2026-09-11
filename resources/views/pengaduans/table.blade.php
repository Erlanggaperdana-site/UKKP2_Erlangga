<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-y border-slate-200">
                <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">No. Pengaduan</th>
                <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">Pengadu</th>
                <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">Isi</th>
                <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500">Tanggal</th>
                <th class="px-5 py-3 text-xs font-medium tracking-wide uppercase text-slate-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            @forelse($pengaduans as $item)
            <tr class="hover:bg-slate-50/70 transition-colors">
                <td class="px-5 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-700 border border-slate-200 font-mono">
                        {{ $item->nomor_pengaduan }}
                    </span>
                </td>
                <td class="px-5 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-slate-900 leading-none">{{ $item->user->name }}</div>
                    <div class="text-xs text-slate-500 mt-1">{{ $item->user->email }}</div>
                </td>
                <td class="px-5 py-4">
                    <div class="text-sm text-slate-600 line-clamp-2 max-w-[28ch] leading-relaxed">
                        {{ Str::limit($item->isi_pengaduan, 64) }}
                    </div>
                </td>
                <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-500">
                    {{ $item->created_at->format('d M Y') }}
                </td>
                <td class="px-5 py-4 whitespace-nowrap text-right">
                    <a href="{{ route('pengaduans.show', $item) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-slate-200 bg-white text-xs font-medium text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-14">
                    <div class="flex flex-col items-center text-center max-w-sm mx-auto">
                        <div class="w-10 h-10 rounded-xl bg-slate-900 text-white grid place-items-center mb-3">
                            <i data-feather="inbox" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900">Belum ada pengaduan</h3>
                        <p class="text-sm text-slate-500 mt-1">Data akan muncul di sini setelah pengaduan dibuat.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
