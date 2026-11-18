@extends('layouts.app')
@section('title', 'Pearl Trails — Discover Uganda. Feel Alive.')
@section('meta_description', 'Discover Uganda with Pearl Trails. From mist-covered gorilla mountains and the roaring River Nile to serene crater lakes and transparent safari budget planning.')

@section('content')
<!-- ==========================================================================
     1. HERO SECTION (Matching Exact Reference Layout)
     ========================================================================== -->
<section class="reference-hero-section" id="heroSection">
    <div class="hero-bg-container">
        <img src="{{ asset('images/destinations/bwindi-gorilla-2.webp') }}" 
             alt="Uganda mist-covered mountains, lakes, and mountain gorilla" 
             class="hero-reference-bg" 
             id="heroReferenceBg">
        <div class="hero-reference-gradient"></div>
    </div>

    <div class="container hero-reference-inner">
        <!-- Hero Text Column -->
        <div class="hero-text-col">
            <!-- Brand Pill Badge -->
            <div class="hero-ref-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                </svg>
                <span>THE PEARL OF AFRICA</span>
                <span class="sr-only">Pearl Trails — Your Uganda. Your Budget. Your Adventure.</span>
            </div>

            <!-- Main High-Contrast Headline -->
            <h1 class="hero-ref-headline">
                Discover Uganda.<br>
                <span class="hero-ref-gold-italic">Feel Alive.</span>
            </h1>

            <p class="hero-ref-lead">
                From mist-covered mountains and breathtaking wildlife to hidden lakes and unforgettable adventures.
            </p>

            <!-- Dual CTA Action Buttons -->
            <div class="hero-ref-cta-row">
                <a href="{{ route('destinations') }}" class="btn-ref-gold">
                    <span>Explore Uganda</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <a href="#destinationPreview" class="btn-ref-outline-glass">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    <span>Watch Experience</span>
                </a>
            </div>

            <!-- Bottom Left: Scroll To Explore Indicator -->
            <a href="#floatingSearchBar" class="hero-ref-scroll">
                <div class="ref-scroll-mouse">
                    <div class="ref-scroll-dot"></div>
                </div>
                <span>Scroll to explore</span>
            </a>
        </div>

        <!-- Hero Right: Carousel Indicator / Switcher -->
        <div class="hero-ref-carousel-control" aria-label="Hero carousel controls">
            <button class="hero-carousel-arrow hero-prev" id="heroPrevBtn" aria-label="Previous slide">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </button>
            <span class="hero-carousel-page" id="heroPageNum">1 / 3</span>
            <button class="hero-carousel-arrow hero-next" id="heroNextBtn" aria-label="Next slide">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </div>
    </div>
</section>

<!-- ==========================================================================
     2. FLOATING SEARCH & FILTER BAR (Overlapping Hero Boundary)
     ========================================================================== -->
<div class="floating-search-wrapper" id="floatingSearchBar">
    <div class="container">
        <form action="{{ route('destinations') }}" method="GET" class="floating-search-glass-bar">
            <!-- Keyword Search -->
            <div class="floating-field floating-field-search">
                <span class="field-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </span>
                <input type="text" name="q" placeholder="Search destinations..." class="floating-input" aria-label="Search destinations">
            </div>

            <div class="floating-field-divider"></div>

            <!-- Region Dropdown -->
            <div class="floating-field floating-field-select">
                <span class="field-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </span>
                <select name="region" class="floating-select" aria-label="Select Region">
                    <option value="">All Regions</option>
                    @foreach($regions ?? ['Western', 'Southwestern', 'Central', 'Eastern', 'Northern'] as $r)
                        <option value="{{ $r }}">{{ $r }} Uganda</option>
                    @endforeach
                </select>
            </div>

            <div class="floating-field-divider"></div>

            <!-- When / Duration Dropdown -->
            <div class="floating-field floating-field-select">
                <span class="field-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </span>
                <select name="duration" class="floating-select" aria-label="Select Duration">
                    <option value="">When? (Duration)</option>
                    <option value="1">1 Day Excursion</option>
                    <option value="2">Weekend (2 Days)</option>
                    <option value="3">3 Days Safari</option>
                    <option value="5">5 Days Expedition</option>
                    <option value="7">7+ Days Grand Tour</option>
                </select>
            </div>

            <div class="floating-field-divider"></div>

            <!-- Travelers Dropdown -->
            <div class="floating-field floating-field-select">
                <span class="field-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span>
                <select name="group" class="floating-select" aria-label="Select Travelers">
                    <option value="">Travelers</option>
                    <option value="Solo">Solo Traveler</option>
                    <option value="Couple">Couple (2 People)</option>
                    <option value="Family">Family / Small Group</option>
                    <option value="Friends">Friends Group (4+)</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-floating-search">
                <span>Search</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </form>
    </div>
</div>

<!-- ==========================================================================
     3. POPULAR DESTINATIONS (Warm Ivory & Topo Contours — 5 Vertical Cards)
     ========================================================================== -->
<section class="section-popular-destinations topo-pattern" id="destinationPreview">
    <div class="container">
        <!-- Header with Gold Kicker -->
        <div class="ref-section-header">
            <span class="ref-kicker">— POPULAR DESTINATIONS —</span>
            <h2 class="ref-headline-serif">Discover places that stay with you long after the journey ends.</h2>
        </div>

        <!-- 5 Vertical Destination Cards Grid with Carousel Navigation -->
        <div class="popular-dest-carousel-wrapper">
            <button class="carousel-nav-btn nav-prev" id="popPrevBtn" aria-label="Previous destination">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </button>

            <div class="popular-dest-cards-row" id="popCardsRow">
                @php
                    $refDestSpecs = [
                        'jinja' => [
                            'tag' => 'Jinja',
                            'title' => 'Jinja',
                            'img' => 'images/recreation-centres/jinja-nile-rafting.webp',
                            'days' => '2-3 days',
                            'style' => 'Adventure',
                            'icon' => '🧗'
                        ],
                        'murchison-falls-np' => [
                            'tag' => 'Murchison Falls NP',
                            'title' => 'Murchison Falls',
                            'img' => 'images/destinations/murchison-falls.webp',
                            'days' => '3-4 days',
                            'style' => 'Wildlife',
                            'icon' => '🦁'
                        ],
                        'bwindi-impenetrable-np' => [
                            'tag' => 'Bwindi Impenetrable NP',
                            'title' => 'Bwindi Impenetrable Forest',
                            'img' => 'images/destinations/bwindi-gorilla-1.webp',
                            'days' => '3-5 days',
                            'style' => 'Wildlife',
                            'icon' => '🦍'
                        ],
                        'sipi-falls' => [
                            'tag' => 'Sipi Falls',
                            'title' => 'Sipi Falls',
                            'img' => 'images/destinations/sipi-falls.webp',
                            'days' => '1-2 days',
                            'style' => 'Nature',
                            'icon' => '🌿'
                        ],
                        'lake-bunyonyi' => [
                            'tag' => 'Lake Bunyonyi',
                            'title' => 'Lake Bunyonyi',
                            'img' => 'images/destinations/lake-bunyonyi.webp',
                            'days' => '2-3 days',
                            'style' => 'Relaxation',
                            'icon' => '🛶'
                        ],
                    ];
                @endphp

                @foreach($refDestSpecs as $slug => $spec)
                    @php
                        $destRecord = $popularDestinations->firstWhere('slug', $slug);
                    @endphp
                    <div class="ref-dest-card">
                        <div class="ref-card-media-box">
                            <img src="{{ asset($spec['img']) }}" alt="{{ $spec['title'] }}" class="ref-card-img" loading="lazy">
                            <div class="ref-card-gradient"></div>
                            
                            <!-- Location Badge on Image -->
                            <div class="ref-loc-badge">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>{{ $spec['tag'] }}</span>
                            </div>
                        </div>

                        <div class="ref-card-body">
                            <h3 class="ref-card-title">{{ $spec['title'] }}</h3>
                            <div class="ref-card-meta-line">
                                <span class="ref-meta-item">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line></svg>
                                    {{ $spec['days'] }}
                                </span>
                                <span class="ref-meta-item">
                                    <span class="ref-meta-emoji">{{ $spec['icon'] }}</span>
                                    {{ $spec['style'] }}
                                </span>
                            </div>

                            <div class="ref-card-bottom-row">
                                <a href="{{ route('destinations.show', $slug) }}" class="ref-view-details-link">
                                    <span>View Details</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                                @if($destRecord)
                                    <span class="ref-price-tag">@price($destRecord->estimated_cost_from_kampala)</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-nav-btn nav-next" id="popNextBtn" aria-label="Next destination">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. FOUR PILLARS VALUE STRIP (Deep Forest Green Ribbon)
     ========================================================================== -->
<section class="section-pillars-strip">
    <div class="container">
        <div class="pillars-ribbon-grid">
            <div class="pillar-ribbon-item">
                <span class="pillar-ribbon-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                    </svg>
                </span>
                <span class="pillar-ribbon-text">Transparent Cost Breakdowns</span>
            </div>

            <div class="pillar-ribbon-item">
                <span class="pillar-ribbon-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </span>
                <span class="pillar-ribbon-text">Community-Backed Listings</span>
            </div>

            <div class="pillar-ribbon-item">
                <span class="pillar-ribbon-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                </span>
                <span class="pillar-ribbon-text">Multi-Currency Flexibility</span>
            </div>

            <div class="pillar-ribbon-item">
                <span class="pillar-ribbon-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </span>
                <span class="pillar-ribbon-text">Curated for Every Travel Style</span>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     5. PLAN YOUR TRIP (Split Feature: Script Photo Card + Concierge Pitch)
     ========================================================================== -->
<section class="section-plan-feature topo-pattern">
    <div class="container">
        <div class="plan-feature-split-layout">
            <!-- Left: Landscape Scenic Card with Script Overlay -->
            <div class="plan-scenic-frame">
                <img src="{{ asset('images/destinations/lake-bunyonyi.webp') }}" 
                     alt="Serene panoramic view of Lake Bunyonyi islands" 
                     class="plan-scenic-img" 
                     loading="lazy">
                <div class="plan-scenic-overlay"></div>

                <!-- Cursive Script Lettering Overlay -->
                <div class="plan-script-badge">
                    <span>Your Journey</span><br>
                    <span class="script-accent">Our Priority</span>
                </div>

                <!-- Watch Video Glass Pill -->
                <a href="{{ route('destinations.show', 'lake-bunyonyi') }}" class="plan-video-pill">
                    <span class="video-play-disc">▶</span>
                    <span>Watch Video</span>
                </a>
            </div>

            <!-- Right: Concierge Pitch & Stats Counters -->
            <div class="plan-pitch-col">
                <span class="ref-kicker">— PLAN YOUR TRIP —</span>
                <h2 class="ref-pitch-headline">Your Journey. Your Budget. Your Uganda.</h2>
                <p class="ref-pitch-desc">
                    Let us help you create the perfect travel experience, tailored to your interests, budget and travel style.
                </p>

                <div class="plan-pitch-action">
                    <a href="{{ route('plan') }}" class="btn-ref-gold">
                        <span>Start Planning</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>

                <!-- 3 Counter Badges (Matching Reference) -->
                <div class="plan-stats-trio">
                    <div class="plan-stat-box">
                        <span class="stat-icon-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18L12 3 3 21z"></path></svg>
                        </span>
                        <span class="stat-number">13+</span>
                        <span class="stat-caption">Destinations</span>
                    </div>

                    <div class="plan-stat-divider"></div>

                    <div class="plan-stat-box">
                        <span class="stat-icon-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </span>
                        <span class="stat-number">100+</span>
                        <span class="stat-caption">Places to Stay</span>
                    </div>

                    <div class="plan-stat-divider"></div>

                    <div class="plan-stat-box">
                        <span class="stat-icon-gold">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </span>
                        <span class="stat-number">50+</span>
                        <span class="stat-caption">Experiences</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     6. EXPLORE BY INTEREST (Deep Midnight Forest Section — 6 Category Cards)
     ========================================================================== -->
<section class="section-explore-interest topo-pattern" id="exploreInterests">
    <div class="container">
        <!-- Header Row -->
        <div class="ref-interest-header-row">
            <div>
                <span class="ref-kicker-gold">— EXPLORE BY INTEREST —</span>
                <h2 class="ref-headline-white">Find Your Kind of Adventure</h2>
            </div>
            <a href="{{ route('interest') }}" class="btn-ref-outline-gold">
                <span>Explore More</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>

        <!-- 6 Interest Cards Grid (Wildlife, Adventure, Culture, Nature, Relaxation, Food) -->
        <div class="interest-hex-grid">
            <!-- 1. Wildlife -->
            <a href="{{ route('interest', ['interest' => 'wildlife']) }}" class="interest-hex-card">
                <div class="hex-media-frame">
                    <img src="{{ asset('images/destinations/bwindi-gorilla-1.webp') }}" alt="Gorilla Wildlife Safari" class="hex-img" loading="lazy">
                    <div class="hex-overlay"></div>
                </div>
                <div class="hex-content">
                    <span class="hex-icon">🦍</span>
                    <h3 class="hex-title">Wildlife</h3>
                    <span class="hex-count">42+</span>
                </div>
            </a>

            <!-- 2. Adventure -->
            <a href="{{ route('interest', ['interest' => 'adventure']) }}" class="interest-hex-card">
                <div class="hex-media-frame">
                    <img src="{{ asset('images/recreation-centres/jinja-nile-rafting.webp') }}" alt="River Nile Adventure Rafting" class="hex-img" loading="lazy">
                    <div class="hex-overlay"></div>
                </div>
                <div class="hex-content">
                    <span class="hex-icon">🧗</span>
                    <h3 class="hex-title">Adventure</h3>
                    <span class="hex-count">35+</span>
                </div>
            </a>

            <!-- 3. Culture -->
            <a href="{{ route('interest', ['interest' => 'culture']) }}" class="interest-hex-card">
                <div class="hex-media-frame">
                    <img src="{{ asset('images/destinations/kasubi-royal-tombs.webp') }}" alt="Ugandan Cultural Heritage" class="hex-img" loading="lazy">
                    <div class="hex-overlay"></div>
                </div>
                <div class="hex-content">
                    <span class="hex-icon">👑</span>
                    <h3 class="hex-title">Culture</h3>
                    <span class="hex-count">18+</span>
                </div>
            </a>

            <!-- 4. Nature -->
            <a href="{{ route('interest', ['interest' => 'nature']) }}" class="interest-hex-card">
                <div class="hex-media-frame">
                    <img src="{{ asset('images/destinations/sipi-falls.webp') }}" alt="Waterfalls and Nature" class="hex-img" loading="lazy">
                    <div class="hex-overlay"></div>
                </div>
                <div class="hex-content">
                    <span class="hex-icon">🌿</span>
                    <h3 class="hex-title">Nature</h3>
                    <span class="hex-count">24+</span>
                </div>
            </a>

            <!-- 5. Relaxation -->
            <a href="{{ route('interest', ['interest' => 'relaxation']) }}" class="interest-hex-card">
                <div class="hex-media-frame">
                    <img src="{{ asset('images/hotels/birdnest-resort-lake-bunyonyi.webp') }}" alt="Lakeside Pool Relaxation" class="hex-img" loading="lazy">
                    <div class="hex-overlay"></div>
                </div>
                <div class="hex-content">
                    <span class="hex-icon">🛶</span>
                    <h3 class="hex-title">Relaxation</h3>
                    <span class="hex-count">15+</span>
                </div>
            </a>

            <!-- 6. Food -->
            <a href="{{ route('eat') }}" class="interest-hex-card">
                <div class="hex-media-frame">
                    <img src="{{ asset('images/restaurants/ugandan-food-platter.webp') }}" alt="Authentic Ugandan Cuisine" class="hex-img" loading="lazy">
                    <div class="hex-overlay"></div>
                </div>
                <div class="hex-content">
                    <span class="hex-icon">🍲</span>
                    <h3 class="hex-title">Food</h3>
                    <span class="hex-count">28+</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- ==========================================================================
     7. GOLDEN SUNSET SAVANNAH BANNER
     ========================================================================== -->
<section class="section-sunset-savannah">
    <div class="savannah-backdrop">
        <img src="{{ asset('images/destinations/kidepo-valley-zebras.webp') }}" 
             alt="Golden sunset savannah landscape in Uganda" 
             class="savannah-img" 
             loading="lazy">
        <div class="savannah-sunset-overlay"></div>
    </div>

    <div class="container savannah-inner">
        <div class="savannah-text">
            <h2 class="savannah-headline">Experience the Pearl of Africa</h2>
            <p class="savannah-subtitle">Plan your next adventure in Uganda today.</p>
        </div>
        <div class="savannah-action">
            <a href="{{ route('plan') }}" class="btn-savannah-gold">
                <span>Plan Your Trip</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>

<!-- ==========================================================================
     8. FEATURED SAFARI LODGES & ACCOMMODATION (Curated Collection)
     ========================================================================== -->
<section class="section-featured-lodges-ref topo-pattern">
    <div class="container">
        <div class="ref-section-header-split">
            <div>
                <span class="ref-kicker">— WHERE TO STAY —</span>
                <h2 class="ref-headline-serif">Handpicked Lodges, Camps &amp; Retreats</h2>
            </div>
            <a href="{{ route('stays') }}" class="ref-view-all-text">
                Browse All Accommodations →
            </a>
        </div>

        <div class="lodges-ref-grid">
            @foreach($featuredStays->take(3) as $stay)
                <div class="lodge-ref-card">
                    <div class="lodge-ref-media">
                        <img src="{{ asset($stay->image_path ?? 'images/destinations/bwindi-gorilla-1.webp') }}" alt="{{ $stay->name }}" class="lodge-ref-img" loading="lazy">
                        <span class="lodge-ref-pill">{{ $stay->type ?? 'Safari Lodge' }}</span>
                    </div>
                    <div class="lodge-ref-body">
                        <span class="lodge-ref-dest">{{ $stay->destination->name ?? 'Uganda' }}</span>
                        <h3 class="lodge-ref-name">{{ $stay->name }}</h3>
                        <p class="lodge-ref-desc">{{ Str::limit($stay->description, 110) }}</p>
                        <div class="lodge-ref-bottom">
                            <div class="lodge-ref-price-box">
                                <span class="lodge-ref-val">@price($stay->price_ugx)</span>
                                <span class="lodge-ref-unit">per {{ $stay->unit }}</span>
                            </div>
                            @if($stay->website)
                                <a href="{{ $stay->website }}" target="_blank" rel="noopener noreferrer" class="browse-action-link">Website ↗</a>
                            @else
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($stay->name . ', ' . ($stay->destination->name ?? 'Uganda') . ', Uganda') }}" target="_blank" rel="noopener noreferrer" class="browse-action-link">Maps ↗</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Hero Carousel & Slider Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hero Image Slider (Gorilla / Murchison / Bunyonyi)
        const heroSlides = [
            {
                img: '{{ asset("images/destinations/bwindi-gorilla-2.webp") }}',
                page: '1 / 3'
            },
            {
                img: '{{ asset("images/destinations/murchison-falls.webp") }}',
                page: '2 / 3'
            },
            {
                img: '{{ asset("images/destinations/lake-bunyonyi.webp") }}',
                page: '3 / 3'
            }
        ];
        let currentSlide = 0;
        const heroBg = document.getElementById('heroReferenceBg');
        const heroPageLabel = document.getElementById('heroPageNum');
        const heroPrev = document.getElementById('heroPrevBtn');
        const heroNext = document.getElementById('heroNextBtn');

        function updateHeroSlide(idx) {
            currentSlide = (idx + heroSlides.length) % heroSlides.length;
            if (heroBg) {
                heroBg.style.opacity = '0.35';
                setTimeout(() => {
                    heroBg.src = heroSlides[currentSlide].img;
                    heroBg.style.opacity = '1';
                }, 200);
            }
            if (heroPageLabel) {
                heroPageLabel.textContent = heroSlides[currentSlide].page;
            }
        }

        if (heroPrev) heroPrev.addEventListener('click', () => updateHeroSlide(currentSlide - 1));
        if (heroNext) heroNext.addEventListener('click', () => updateHeroSlide(currentSlide + 1));

        // Horizontal scroll for popular destination cards
        const popRow = document.getElementById('popCardsRow');
        const popPrev = document.getElementById('popPrevBtn');
        const popNext = document.getElementById('popNextBtn');
        if (popRow && popPrev && popNext) {
            popPrev.addEventListener('click', () => {
                popRow.scrollBy({ left: -320, behavior: 'smooth' });
            });
            popNext.addEventListener('click', () => {
                popRow.scrollBy({ left: 320, behavior: 'smooth' });
            });
        }
    });
</script>
@endsection