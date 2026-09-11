<div class="flex flex-col items-center justify-center p-10 bg-white rounded-2xl border border-slate-200">
    <div class="w-10 h-10 rounded-xl bg-slate-900 text-white grid place-items-center mb-4">
        <i data-feather="inbox" class="w-5 h-5"></i>
    </div>
    <h3 class="text-sm font-semibold text-slate-900">{{ $title }}</h3>
    <p class="text-sm text-slate-500 text-center max-w-sm mt-1">{{ $message }}</p>
    @if(isset($action))
    <div class="mt-5">
        {!! $action !!}
    </div>
    @endif
</div>
