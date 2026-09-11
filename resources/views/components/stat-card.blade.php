<div class="bg-white rounded-2xl border border-slate-200 p-5">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-xs font-medium tracking-wide uppercase text-slate-500">{{ $label }}</p>
            <p class="text-2xl font-semibold tracking-tight text-slate-900 mt-2">{{ $value }}</p>
        </div>
        @if(isset($icon))
        <div class="w-9 h-9 rounded-xl bg-slate-900 text-white grid place-items-center shrink-0">
            {!! $icon !!}
        </div>
        @endif
    </div>
</div>
