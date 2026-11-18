<section class="section-closing-banner" aria-label="Closing Call to Action">
    @php
        $sunsetImg = 'images/sections/sunset-savannah.webp';
        if (!file_exists(public_path($sunsetImg))) {
            $sunsetImg = 'images/destinations/kazuma-hill-lookout-panoramic-deck.webp';
        }
    @endphp
    @if(file_exists(public_path($sunsetImg)))
        <img src="{{ asset($sunsetImg) }}" 
             alt="Uganda Savannah Sunset" 
             class="closing-banner-bg" 
             loading="lazy" 
             width="1920" height="600">
    @else
        <div class="closing-banner-bg" style="background: linear-gradient(135deg, #1d4a32 0%, #12301f 100%);"></div>
    @endif

    <div class="closing-banner-overlay" aria-hidden="true"></div>

    <div class="closing-banner-content">
        <h2 class="closing-banner-title">Experience the Pearl of Africa</h2>
        <p class="closing-banner-sub">Plan your next adventure in Uganda today.</p>
        <a href="{{ route('plan') }}" class="btn-gold-pill" style="padding: 0.9rem 2.2rem; font-size: 1rem;">
            <span>Plan Your Trip</span>
            <span aria-hidden="true">&rarr;</span>
        </a>
    </div>
</section>
