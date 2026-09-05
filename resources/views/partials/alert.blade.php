@if(session('success'))
<div class="alert alert-success d-flex align-items-start mb-4" role="alert">
    <i class="bi bi-check-circle-fill me-3 fs-5 mt-1"></i>
    <div class="flex-grow-1">
        <h6 class="alert-heading mb-1 fw-bold">Berhasil</h6>
        <p class="mb-0 opacity-75" style="font-size: 13px;">{{ session('success') }}</p>
    </div>
    <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger d-flex align-items-start mb-4" role="alert">
    <i class="bi bi-x-circle-fill me-3 fs-5 mt-1"></i>
    <div class="flex-grow-1">
        <h6 class="alert-heading mb-1 fw-bold">Periksa kembali input Anda</h6>
        <ul class="mb-0 opacity-75 ps-3" style="font-size: 13px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'" aria-label="Close"></button>
</div>
@endif
