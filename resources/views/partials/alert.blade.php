@if(session('success'))
<div id="toast-success" class="fixed top-5 right-5 z-[100] transform opacity-0 translate-x-8 pointer-events-none"
     style="transition: transform 0.6s cubic-bezier(0.16,1,0.3,1), opacity 0.6s cubic-bezier(0.16,1,0.3,1); will-change: transform, opacity;">
    <div class="bg-white/95 backdrop-blur-md border border-slate-200/80 border-l-4 border-l-emerald-500 rounded-2xl shadow-xl shadow-slate-900/5 p-4 flex items-start max-w-sm w-full">
        <div class="w-8 h-8 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 grid place-items-center mr-3 shrink-0">
            <i data-feather="check-circle" class="w-4 h-4"></i>
        </div>
        <div class="flex-grow min-w-0">
            <h6 class="text-slate-900 font-semibold mb-0.5 text-sm">Berhasil</h6>
            <p class="text-slate-500 text-xs m-0 leading-relaxed break-words">{{ session('success') }}</p>
        </div>
        <button type="button" class="text-slate-400 hover:text-slate-700 hover:bg-slate-100 p-1 rounded-lg transition ml-3 shrink-0" onclick="closeToast('toast-success')" aria-label="Close">
            <i data-feather="x" class="w-4 h-4"></i>
        </button>
    </div>
</div>
<script>
(function(){
    var t = document.getElementById('toast-success');
    if(!t) return;
    requestAnimationFrame(function(){
        requestAnimationFrame(function(){
            t.classList.remove('opacity-0', 'translate-x-8', 'pointer-events-none');
            t.classList.add('opacity-100', 'translate-x-0');
        });
    });
    setTimeout(function(){ closeToast('toast-success'); }, 4500);
})();
</script>
@endif

@if($errors->any())
<div id="toast-error" class="fixed top-5 right-5 z-[100] transform opacity-0 translate-x-8 pointer-events-none"
     style="transition: transform 0.6s cubic-bezier(0.16,1,0.3,1), opacity 0.6s cubic-bezier(0.16,1,0.3,1); will-change: transform, opacity;">
    <div class="bg-white/95 backdrop-blur-md border border-slate-200/80 border-l-4 border-l-rose-500 rounded-2xl shadow-xl shadow-slate-900/5 p-4 flex items-start max-w-sm w-full">
        <div class="w-8 h-8 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 grid place-items-center mr-3 shrink-0">
            <i data-feather="alert-circle" class="w-4 h-4"></i>
        </div>
        <div class="flex-grow min-w-0">
            <h6 class="text-slate-900 font-semibold mb-0.5 text-sm">Periksa kembali input Anda</h6>
            <ul class="text-slate-500 text-xs list-disc pl-4 m-0 space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="text-slate-400 hover:text-slate-700 hover:bg-slate-100 p-1 rounded-lg transition ml-3 shrink-0" onclick="closeToast('toast-error')" aria-label="Close">
            <i data-feather="x" class="w-4 h-4"></i>
        </button>
    </div>
</div>
<script>
(function(){
    var t = document.getElementById('toast-error');
    if(!t) return;
    requestAnimationFrame(function(){
        requestAnimationFrame(function(){
            t.classList.remove('opacity-0', 'translate-x-8', 'pointer-events-none');
            t.classList.add('opacity-100', 'translate-x-0');
        });
    });
    setTimeout(function(){ closeToast('toast-error'); }, 6000);
})();
</script>
@endif

<script>
function closeToast(id) {
    var t = document.getElementById(id);
    if(!t) return;
    t.classList.remove('opacity-100', 'translate-x-0');
    t.classList.add('opacity-0', 'translate-x-8', 'pointer-events-none');
    setTimeout(function(){ t.style.display = 'none'; }, 620);
}
</script>
