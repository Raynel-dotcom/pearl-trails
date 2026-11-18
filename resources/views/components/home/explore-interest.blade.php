<section class="section-explore-interest" aria-label="Explore by Interest">
    <div class="interest-header-row">
        <div>
            <span class="section-kicker-gold" style="color: var(--gold-soft);">Explore by Interest</span>
            <h2 class="section-title-serif" style="color: var(--white);">Find Your Kind of Adventure</h2>
        </div>
        <a href="{{ route('interest') }}" class="btn-explore-more">
            <span>Explore More</span>
            <span aria-hidden="true">&rarr;</span>
        </a>
    </div>

    @php
        $interests = [
            [
                'name' => 'Wildlife',
                'slug' => 'wildlife',
                'image' => 'images/interests/wildlife.webp',
                'fallback' => 'images/destinations/bwindi-gorilla-2.webp',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-5l4.5 2.5-4.5 2.5z"/></svg>'
            ],
            [
                'name' => 'Adventure',
                'slug' => 'adventure',
                'image' => 'images/interests/adventure.webp',
                'fallback' => 'images/destinations/jinja-quad-biking.webp',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>'
            ],
            [
                'name' => 'Culture',
                'slug' => 'culture',
                'image' => 'images/interests/culture.webp',
                'fallback' => 'images/destinations/kasubi-royal-tombs.webp',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v4M12 14v4M16 14v4"/></svg>'
            ],
            [
                'name' => 'Nature',
                'slug' => 'nature',
                'image' => 'images/interests/nature.webp',
                'fallback' => 'images/destinations/sipi-falls.webp',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 22h20L12 2zm0 6l5 10H7l5-10z"/></svg>'
            ],
            [
                'name' => 'Relaxation',
                'slug' => 'relaxation',
                'image' => 'images/interests/relaxation.webp',
                'fallback' => 'images/destinations/arcadia-360-degree-hills-viewpoint.webp',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>'
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'image' => 'images/interests/food.webp',
                'fallback' => 'images/restaurants/ugandan-food-platter.webp',
                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>'
            ],
        ];
    @endphp

    <div class="interest-tiles-grid">
        @foreach($interests as $item)
            @php
                $img = file_exists(public_path($item['image'])) ? asset($item['image']) : (file_exists(public_path($item['fallback'])) ? asset($item['fallback']) : null);
            @endphp
            <a href="{{ route('interest', ['interest' => $item['name']]) }}" class="interest-tile-card" aria-label="Explore {{ $item['name'] }}">
                @if($img)
                    <img src="{{ $img }}" alt="{{ $item['name'] }}" class="interest-tile-img" loading="lazy" width="220" height="240">
                @else
                    <div class="interest-tile-img" style="background: linear-gradient(135deg, var(--forest-2), var(--forest));"></div>
                @endif
                <div class="interest-tile-overlay" aria-hidden="true"></div>
                <div class="interest-tile-content">
                    <div class="interest-tile-icon" aria-hidden="true">
                        {!! $item['icon'] !!}
                    </div>
                    <span class="interest-tile-label">{{ $item['name'] }}</span>
                </div>
            </a>
        @endforeach
    </div>
</section>
