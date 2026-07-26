<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
        <span class="info-box-icon text-bg-primary shadow-sm">
            <i class="{{ $icon }}"></i>
        </span>

        <div class="info-box-content">
            <span class="info-box-text">{{ $label }}</span>
            @if($text)
                <small class="text-muted">{{ $text }}</small>
            @endif
            <span class="info-box-number">
                {{ $value }}
                @if($unit)
                    <small>{{ $unit }}</small>
                @endif
            </span>
        </div>
    </div>
</div>