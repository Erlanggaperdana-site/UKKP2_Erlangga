<div class="row g-4 animate-fade-in animate-delay-2">
    <div class="col-lg-8">
        <div class="content-card h-100">
            <div class="card-header">
                Pengaduan Terbaru
            </div>
            @include('pengaduans.table', ['simple' => true])
        </div>
    </div>

    <div class="col-lg-4">
        <div class="content-card h-100">
            <div class="card-header">
                User Terbaru
            </div>
            <div class="card-body p-0">
                <ul class="list-unstyled mb-0">
                    @forelse($users as $user)
                    <li class="d-flex align-items-center justify-content-between p-3 border-bottom {{ $loop->last ? 'border-0' : '' }}">
                        <div class="d-flex align-items-center gap-3 overflow-hidden">
                            <div class="avatar-circle avatar-blue">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="text-truncate">
                                <div class="fw-medium text-dark text-truncate" style="font-size: 13.5px;">{{ $user->name }}</div>
                                <div class="text-muted text-truncate" style="font-size: 12px;">{{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="ms-2 flex-shrink-0">
                            <span class="badge {{ $user->role === 'admin' ? 'badge-role-admin' : ($user->role === 'petugas' ? 'badge-role-petugas' : 'badge-role-customer') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </li>
                    @empty
                    <li class="empty-state">
                        <i class="bi bi-people"></i>
                        <strong>Belum ada data user</strong>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
