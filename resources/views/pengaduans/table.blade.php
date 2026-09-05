<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No. Pengaduan</th>
                <th>Pengadu</th>
                <th>Isi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $item)
            <tr>
                <td>
                    <span class="code-badge">{{ $item->nomor_pengaduan }}</span>
                </td>
                <td class="fw-medium text-dark">{{ $item->user->name }}</td>
                <td>
                    <div class="truncate-2 text-muted" style="max-width: 300px;">
                        {{ Str::limit($item->isi_pengaduan, 55) }}
                    </div>
                </td>
                <td class="text-nowrap text-muted">{{ $item->created_at->format('d M Y') }}</td>
                <td class="text-nowrap">
                    <a href="{{ route('pengaduans.show', $item) }}" class="btn btn-primary btn-sm">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <i class="bi bi-file-text"></i>
                        <strong>Belum ada pengaduan</strong>
                        <p>Data pengaduan akan muncul di sini</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
