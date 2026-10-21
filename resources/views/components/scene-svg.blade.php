@props([
    'destination',
    'height' => '220px',
    'width' => '100%',
    'class' => 'scene-svg-wrapper'
])

@php
    $slug = $destination->slug ?? 'uganda';
    $name = $destination->name ?? 'Uganda';
    $from = $destination->gradient_from ?? '#0F4C3A';
    $to = $destination->gradient_to ?? '#D4AF37';
    $realImage = $destination->image_path;
    $localImagePath = "images/destinations/{$slug}.jpg";
    $hasLocalImage = file_exists(public_path($localImagePath));
@endphp

<div class="{{ $class }}" style="width: {{ $width }}; height: {{ $height }}; position: relative; overflow: hidden; background: linear-gradient(135deg, {{ $from }}, {{ $to }}); border-top-left-radius: inherit; border-top-right-radius: inherit;">
    @if($realImage)
        <img src="{{ asset($realImage) }}" alt="{{ $name }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
    @elseif($hasLocalImage)
        <img src="{{ asset($localImagePath) }}" alt="{{ $name }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
    @else
        <!-- Procedural SVG Scene Art -->
        <svg viewBox="0 0 400 240" preserveAspectRatio="xMidYMid slice" style="width: 100%; height: 100%; display: block;" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="sky_{{ $slug }}" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="{{ $from }}" />
                    <stop offset="100%" stop-color="{{ $to }}" />
                </linearGradient>
                <linearGradient id="water_{{ $slug }}" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#083327" stop-opacity="0.8" />
                    <stop offset="100%" stop-color="#14281F" stop-opacity="0.95" />
                </linearGradient>
                <linearGradient id="hill1_{{ $slug }}" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#1B7B59" stop-opacity="0.6" />
                    <stop offset="100%" stop-color="#0F4C3A" stop-opacity="0.9" />
                </linearGradient>
                <linearGradient id="hill2_{{ $slug }}" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#0F4C3A" stop-opacity="0.8" />
                    <stop offset="100%" stop-color="#083327" stop-opacity="1" />
                </linearGradient>
            </defs>

            <!-- Sky background -->
            <rect width="400" height="240" fill="url(#sky_{{ $slug }})" />

            <!-- Sun / Moon Glow -->
            <circle cx="310" cy="65" r="32" fill="#D4AF37" opacity="0.35" />
            <circle cx="310" cy="65" r="22" fill="#FFF8E7" opacity="0.85" />

            <!-- Distant Mountains / Horizon -->
            @if(in_array($slug, ['rwenzori', 'sipi-falls', 'fort-portal', 'bwindi']))
                <!-- Jagged high peaks -->
                <polygon points="-20,180 80,70 170,180" fill="url(#hill1_{{ $slug }})" opacity="0.7" />
                <polygon points="120,180 240,45 350,180" fill="url(#hill1_{{ $slug }})" opacity="0.8" />
                <polygon points="280,180 370,80 430,180" fill="url(#hill1_{{ $slug }})" opacity="0.6" />
                @if($slug === 'rwenzori')
                    <!-- Glacial snow caps -->
                    <polygon points="230,60 240,45 250,60 245,64 240,58 235,64" fill="#FFFFFF" opacity="0.95" />
                    <polygon points="73,80 80,70 87,80 84,83 80,78 76,83" fill="#FFFFFF" opacity="0.95" />
                @endif
            @else
                <!-- Soft Rolling Hills -->
                <path d="M -20,160 Q 90,110 200,150 T 420,140 L 420,240 L -20,240 Z" fill="url(#hill1_{{ $slug }})" opacity="0.75" />
            @endif

            <!-- Water Bodies (Lakes, Falls, Rivers) -->
            @if(in_array($slug, ['jinja', 'murchison-falls-np', 'lake-bunyonyi', 'ssese-islands', 'entebbe', 'queen-elizabeth-np', 'lake-mburo-np']))
                <path d="M -10,175 Q 100,160 200,175 T 410,170 L 410,240 L -10,240 Z" fill="url(#water_{{ $slug }})" />
                <!-- Water ripple lines -->
                <path d="M 40,195 Q 80,190 130,195" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round" opacity="0.4" fill="none" />
                <path d="M 210,205 Q 260,200 320,205" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round" opacity="0.3" fill="none" />
                <path d="M 110,220 Q 170,215 240,220" stroke="#FFF8E7" stroke-width="1.2" stroke-linecap="round" opacity="0.3" fill="none" />
            @endif

            <!-- Waterfall Plume for Murchison & Sipi -->
            @if(in_array($slug, ['murchison-falls-np', 'sipi-falls']))
                <path d="M 185,100 L 195,190 L 215,190 L 210,100 Z" fill="#FFFFFF" opacity="0.85" />
                <ellipse cx="202" cy="190" rx="30" ry="12" fill="#FFFFFF" opacity="0.5" />
            @endif

            <!-- Foreground Terrain -->
            <path d="M -20,195 Q 110,175 220,195 T 430,185 L 430,240 L -20,240 Z" fill="url(#hill2_{{ $slug }})" />

            <!-- African Acacia & Palm Silhouettes -->
            @if(in_array($slug, ['ssese-islands', 'entebbe']))
                <!-- Palm trees -->
                <path d="M 50,215 Q 52,170 58,140" stroke="#083327" stroke-width="3" fill="none" />
                <path d="M 58,140 Q 35,130 20,140 M 58,140 Q 50,115 45,105 M 58,140 Q 75,115 85,115 M 58,140 Q 85,135 95,145" stroke="#083327" stroke-width="2.5" fill="none" />
            @elseif(in_array($slug, ['murchison-falls-np', 'kidepo', 'queen-elizabeth-np', 'lake-mburo-np', 'jinja']))
                <!-- Flat-top Umbrella Acacia -->
                <path d="M 60,210 L 62,150 M 62,170 L 45,150 M 62,165 L 78,148" stroke="#083327" stroke-width="3.5" stroke-linecap="round" />
                <ellipse cx="60" cy="145" rx="34" ry="9" fill="#083327" />
                <ellipse cx="45" cy="148" rx="16" ry="6" fill="#083327" />
                <ellipse cx="78" cy="147" rx="16" ry="6" fill="#083327" />
            @endif

            <!-- Birds Silhouette in Sky -->
            <path d="M 140,55 Q 146,48 152,55 Q 158,48 164,55" stroke="#14281F" stroke-width="1.8" fill="none" opacity="0.75" />
            <path d="M 168,45 Q 172,40 176,45 Q 180,40 184,45" stroke="#14281F" stroke-width="1.4" fill="none" opacity="0.6" />

            <!-- Subtle Destination Badge Tag on SVG -->
            <g transform="translate(16, 20)">
                <rect width="{{ strlen($name) * 8 + 24 }}" height="26" rx="13" fill="#0F4C3A" opacity="0.75" />
                <text x="12" y="17" fill="#FFF8E7" font-family="-apple-system, BlinkMacSystemFont, sans-serif" font-size="11" font-weight="700" letter-spacing="0.5">
                    {{ strtoupper($name) }}
                </text>
            </g>
        </svg>
    @endif
</div>
