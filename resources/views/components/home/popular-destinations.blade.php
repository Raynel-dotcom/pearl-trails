@props(['destinations' => []])

<section class="section-popular-destinations" aria-label="Popular Destinations">
    <div class="destinations-carousel-header">
        <span class="section-kicker-gold">Popular Destinations</span>
        <h2 class="section-title-serif">Discover places that stay with you long after the journey ends.</h2>
    </div>

    <div class="carousel-viewport-wrapper">
        <!-- Prev Arrow -->
        <button type="button" class="carousel-nav-btn carousel-nav-prev" id="destCarouselPrev" aria-label="Previous Destinations">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>

        <!-- Carousel Track with Scroll-Snap -->
        <div class="destinations-cards-track" id="destCarouselTrack" tabindex="0" role="region" aria-label="Destinations Carousel">
            @foreach($destinations as $dest)
                @php
                    $durationText = ($dest->min_days ?? 2) . '-' . ($dest->max_days ?? 3) . ' days';
                    $mainInterest = is_array($dest->interests) ? ($dest->interests[0] ?? 'Adventure') : 'Adventure';
                    
                    // Image lookup priority: DB path -> local webp asset -> fallback
                    $imageSrc = null;
                    if (!empty($dest->image_path) && file_exists(public_path($dest->image_path))) {
                        $imageSrc = asset($dest->image_path);
                    } else {
                        $slugMaps = [
                            'jinja' => 'images/destinations/jinja-quad-biking.webp',
                            'murchison-falls-np' => 'images/destinations/murchison-falls.webp',
                            'bwindi' => 'images/destinations/bwindi-gorilla-1.webp',
                            'sipi-falls' => 'images/destinations/sipi-falls.webp',
                            'lake-bunyonyi' => 'images/destinations/lake-bunyonyi.webp',
                            'ssese-islands' => 'images/destinations/ssese-islands.webp',
                            'queen-elizabeth-np' => 'images/destinations/boat-cruise-elephants.webp',
                            'kidepo' => 'images/destinations/buffalo-herd-savanna.webp',
                            'lake-mburo-np' => 'images/destinations/lake-mburo-zebras.webp',
                        ];
                        if (isset($slugMaps[$dest->slug]) && file_exists(public_path($slugMaps[$dest->slug]))) {
                            $imageSrc = asset($slugMaps[$dest->slug]);
                        }
                    }
                @endphp

                <a href="{{ route('destinations.show', $dest->slug) }}" class="popular-dest-card" aria-label="View {{ $dest->name }} Details">
                    <div class="popular-dest-media">
                        @if($imageSrc)
                            @php
                                $popImg2x = str_replace('.webp', '@2x.webp', $imageSrc);
                                // Parse local relative path for file_exists check
                                $localRelPath = parse_url($imageSrc, PHP_URL_PATH);
                                $localRelPath = ltrim($localRelPath, '/');
                                $localRelPath2x = str_replace('.webp', '@2x.webp', $localRelPath);
                                $popHas2x = file_exists(public_path($localRelPath2x));
                            @endphp
                            <img src="{{ $imageSrc }}" 
                                 @if($popHas2x) srcset="{{ $imageSrc }} 1x, {{ $popImg2x }} 2x" @endif
                                 alt="{{ $dest->name }}" 
                                 class="popular-dest-img" 
                                 loading="lazy" 
                                 width="320" height="420">
                        @else
                            <x-scene-svg :destination="$dest" height="100%" />
                        @endif
                        <div class="popular-dest-gradient" aria-hidden="true"></div>
                    </div>

                    <div class="popular-dest-content">
                        <!-- Location Pill -->
                        <div class="dest-top-pill">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>{{ $dest->name }}</span>
                        </div>

                        <!-- Bottom Info -->
                        <div class="dest-bottom-info">
                            <h3 class="dest-card-name">{{ $dest->name }}</h3>
                            <div class="dest-meta-strip">
                                <span class="dest-meta-item">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    {{ $durationText }}
                                </span>
                                <span class="dest-meta-item">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                    {{ $mainInterest }}
                                </span>
                            </div>
                            <span class="dest-card-cta">
                                <span>View Details</span>
                                <span aria-hidden="true">&rarr;</span>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Next Arrow -->
        <button type="button" class="carousel-nav-btn carousel-nav-next" id="destCarouselNext" aria-label="Next Destinations">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
    </div>
</section>

<!-- Carousel Interaction Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('destCarouselTrack');
    const prevBtn = document.getElementById('destCarouselPrev');
    const nextBtn = document.getElementById('destCarouselNext');
    if (!track) return;

    const scrollAmount = 300;

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
    }
});
</script>
