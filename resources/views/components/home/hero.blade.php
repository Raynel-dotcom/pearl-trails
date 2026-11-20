@props(['slides' => [], 'hasVideo' => false])

<section class="hero-editorial-section" id="heroSection" aria-label="Hero Introduction">
    <!-- Background Slides Container -->
    <div class="hero-slider-bg" id="heroSliderBg" aria-live="polite">
        @foreach($slides as $index => $slide)
            @php
                $parts = explode('/', $slide->title ?? 'Discover Uganda. / Feel Alive.');
                $mainText = trim($parts[0] ?? 'Discover Uganda.');
                $italicText = trim($parts[1] ?? 'Feel Alive.');
                $subText = $slide->subtitle ?? 'From mist-covered mountains and breathtaking wildlife to hidden lakes and unforgettable adventures.';
            @endphp
            <div class="hero-slide-item {{ $index === 0 ? 'active' : '' }}" 
                 data-slide-index="{{ $index }}"
                 data-main="{{ $mainText }}"
                 data-italic="{{ $italicText }}"
                 data-subtitle="{{ $subText }}">
                @if(!empty($slide->image_path) && file_exists(public_path($slide->image_path)))
                    @php
                        $img1x = $slide->image_path;
                        $img2x = str_replace('.webp', '@2x.webp', $slide->image_path);
                        $v1x = file_exists(public_path($img1x)) ? filemtime(public_path($img1x)) : time();
                        $hasHero2x = file_exists(public_path($img2x));
                        $v2x = $hasHero2x ? filemtime(public_path($img2x)) : $v1x;
                    @endphp
                    <img src="{{ asset($img1x) }}?v={{ $v1x }}" 
                         @if($hasHero2x) srcset="{{ asset($img1x) }}?v={{ $v1x }} 1x, {{ asset($img2x) }}?v={{ $v2x }} 2x" @endif
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
            <h1 class="hero-headline" id="heroHeadline">
                Discover Uganda.
                <span class="hero-headline-italic" id="heroHeadlineItalic">Feel Alive.</span>
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtext" id="heroSubtext">
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

        <!-- Slide Navigation on bottom-right -->
        <div class="hero-slide-controls" aria-label="Slide Navigation">
            <button type="button" class="slide-arrow-btn" id="heroPrevBtn" aria-label="Previous Slide">&larr;</button>
            <div class="hero-slide-dots" id="heroSlideDots">
                @foreach($slides as $index => $slide)
                    <button type="button" class="slide-dot {{ $index === 0 ? 'active' : '' }}" data-dot-index="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
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
    const slides = document.querySelectorAll('.hero-slide-item');
    const dots = document.querySelectorAll('.slide-dot');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');
    const headline = document.getElementById('heroHeadline');
    const subtext = document.getElementById('heroSubtext');
    if (!slides.length) return;

    let current = 0;
    const total = slides.length;
    let timer = null;
    const intervalTime = 4500;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function showSlide(index) {
        slides[current].classList.remove('active');
        if (dots[current]) dots[current].classList.remove('active');
        current = (index + total) % total;
        const activeSlide = slides[current];
        activeSlide.classList.add('active');
        if (dots[current]) dots[current].classList.add('active');

        // Update headline and subtitle smoothly
        if (headline && subtext && activeSlide.dataset) {
            headline.style.opacity = '0';
            subtext.style.opacity = '0';
            setTimeout(() => {
                const main = activeSlide.dataset.main || 'Discover Uganda.';
                const italic = activeSlide.dataset.italic || 'Feel Alive.';
                const sub = activeSlide.dataset.subtitle || '';
                headline.innerHTML = `${main} <span class="hero-headline-italic">${italic}</span>`;
                subtext.textContent = sub;
                headline.style.opacity = '1';
                subtext.style.opacity = '1';
            }, 250);
        }
    }

    if (headline) headline.style.transition = 'opacity 0.25s ease';
    if (subtext) subtext.style.transition = 'opacity 0.25s ease';

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

    dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => {
            showSlide(idx);
            startAutoSlide();
        });
    });

    startAutoSlide();
});
</script>
