@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'auth-error-list']) }}>
        @foreach ((array) $messages as $message)
            <div class="auth-field-error">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ $message }}</span>
            </div>
        @endforeach
    </div>
@endif
