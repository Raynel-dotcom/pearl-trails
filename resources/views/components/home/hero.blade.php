@props(['slides' => [], 'hasVideo' => false])

<section class="hero-editorial-section" id="heroSection" aria-label="Hero Introduction">
    <!-- Background Slides Container -->
    <div class="hero-slider-bg" id="heroSliderBg" aria-live="polite">
        @foreach($slides as $index => $slide)
            <div class="hero-slide-item {{ $index === 0 ? 'active' : '' }}" data-slide-index="{{ $index }}">
                @if(!empty($slide->image_path) && file_exists(public_path($slide->image_path)))
                    <img src="{{ asset($slide->image_path) }}" 
                         alt="{{ $slide->title ?? 'Uganda Landscape' }}" 
                         class="hero-slide-media"
                         {{ $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"' }}
                         width="1920" height="1080">
                @else
                    <div class="hero-slide-fallback" style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--forest) 0%, var(--forest-2) 100%);"></div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Gradient Overlay for Contrast -->
    <div class="hero-gradient-overlay" aria-hidden="true"></div>

    <!-- Hero Content -->
    <div class="hero-content-wrapper">
        <div class="hero-text-block">
            <!-- Location Badge -->
            <div class="hero-pill-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span>THE PEARL OF AFRICA</span>
            </div>

            <!-- Headline -->
            <h1 class="hero-headline">
                Discover Uganda.
                <span class="hero-headline-italic">Feel Alive.</span>
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtext">
                From mist-covered mountains and breathtaking wildlife to hidden lakes and unforgettable adventures.
            </p>

            <!-- Dual CTAs -->
            <div class="hero-cta-group">
                <a href="{{ route('destinations') }}" class="btn-hero-primary">
                    Explore Uganda &rarr;
                </a>
                @if($hasVideo)
                    <button type="button" class="btn-hero-glass" id="openHeroVideoBtn" aria-label="Watch Experience Video">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <span>Watch Experience</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Hero Footer Navigation Bar -->
    <div class="hero-footer-bar">
        <!-- Scroll indicator on bottom-left -->
        <div class="hero-scroll-indicator" aria-hidden="true">
            <span class="mouse-icon"></span>
            <span>Scroll to explore</span>
        </div>

        <!-- 1/3 slide counter and arrows on bottom-right -->
        <div class="hero-slide-controls" aria-label="Slide Navigation">
            <button type="button" class="slide-arrow-btn" id="heroPrevBtn" aria-label="Previous Slide">&larr;</button>
            <span class="slide-counter-display" id="heroSlideCounter">1 / {{ count($slides) ?: 3 }}</span>
            <button type="button" class="slide-arrow-btn" id="heroNextBtn" aria-label="Next Slide">&rarr;</button>
        </div>
    </div>

    <!-- Gentle Curve Edge at bottom -->
    <div class="hero-curve-separator" aria-hidden="true">
        <svg viewBox="0 0 1440 48" fill="none" preserveAspectRatio="none">
            <path d="M0,0 C480,48 960,48 1440,0 L1440,48 L0,48 Z"></path>
        </svg>
    </div>
</section>

<!-- Hero Slider Vanilla JS -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('heroSection');
    const slides = document.querySelectorAll('.hero-slide-item');
    const counter = document.getElementById('heroSlideCounter');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');
    if (!slides.length) return;

    let current = 0;
    const total = slides.length;
    let timer = null;
    const intervalTime = 6000;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function showSlide(index) {
        slides[current].classList.remove('active');
        current = (index + total) % total;
        slides[current].classList.add('active');
        if (counter) counter.textContent = `${current + 1} / ${total}`;
    }

    function startAutoSlide() {
        if (prefersReducedMotion || total <= 1) return;
        stopAutoSlide();
        timer = setInterval(() => {
            showSlide(current + 1);
        }, intervalTime);
    }

    function stopAutoSlide() {
        if (timer) clearInterval(timer);
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            showSlide(current - 1);
            startAutoSlide();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            showSlide(current + 1);
            startAutoSlide();
        });
    }

    if (section) {
        section.addEventListener('mouseenter', stopAutoSlide);
        section.addEventListener('mouseleave', startAutoSlide);
    }

    startAutoSlide();
});
</script>
