<div class="stat-card">
    <div class="flex items-start justify-between">
        <div>
            <p class="stat-label">{{ $label }}</p>
            <p class="stat-value">{{ $value }}</p>
        </div>
        @if(isset($icon))
        <div class="stat-icon text-3xl">
            {!! $icon !!}
        </div>
        @endif
    </div>
</div>
