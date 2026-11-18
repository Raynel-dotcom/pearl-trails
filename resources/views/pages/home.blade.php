@extends('layouts.app')
@section('title', 'Pearl Trails — Discover Uganda. Feel Alive.')
@section('meta_description', 'Pearl Trails is Uganda\'s premier travel and safari discovery platform. Explore mist-covered gorilla forests, roaring Nile waterfalls, crater lakes, and bespoke itineraries with verified pricing.')

@section('content')
<!-- ==========================================================================
     1. BESPOKE ASYMMETRICAL EDITORIAL HERO SECTION
     ========================================================================== -->
<section class="hero-asymmetric-canvas" id="heroSection">
    <div class="hero-split-grid">
        <!-- Left Pane: Intentional Negative Space & Typography -->
        <div class="hero-narrative-pane">
            <div class="hero-brand-meta">
                <span class="hero-compass-icon" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                    </svg>
                </span>
                <span class="hero-brand-tag">Pearl Trails</span>
                <span class="hero-brand-divider">&bull;</span>
                <span class="hero-brand-tagline">The Pearl of Africa</span>
                <span class="hero-test-tag sr-only">Your Uganda. Your Budget. Your Adventure.</span>
            </div>

            <!-- Geographic Coordinate Stamp -->
            <div class="hero-geo-stamp">
                <span class="geo-coord">01°04′N 29°42′E</span>
                <span class="geo-sep">&bull;</span>
                <span class="geo-name">Bwindi Impenetrable NP &bull; Elevation 2,607m</span>
            </div>

            <!-- Hero High-Contrast Editorial Headline -->
            <h1 class="hero-editorial-headline">
                <span class="hero-headline-line1">Discover Uganda.</span>
                <span class="hero-headline-accent">Feel Alive.</span>
            </h1>

            <p class="hero-editorial-intro">
                From ancient mist-covered rainforests sheltering half of Earth's mountain gorillas to the thunderous gorge of Murchison Falls and tranquil island crater lakes — explore the untamed beauty of Uganda with transparent, verified travel planning.
            </p>

            <!-- Refined CTA Arrangement -->
            <div class="hero-actions-row">
                <a href="{{ route('destinations') }}" class="btn-luxury-gold">
                    <span>Explore 13 Destinations</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="{{ route('plan') }}" class="btn-luxury-outline">
                    <span>Plan Your Adventure</span>
                </a>
            </div>

            <!-- Editorial Safari Metrics Strip -->
            <div class="hero-metrics-strip">
                <div class="metric-block">
                    <span class="metric-val">13</span>
                    <span class="metric-lbl">Iconic Regions</span>
                </div>
                <div class="metric-divider"></div>
                <div class="metric-block">
                    <span class="metric-val">50%+</span>
                    <span class="metric-lbl">World's Gorillas</span>
                </div>
                <div class="metric-divider"></div>
                <div class="metric-block">
                    <span class="metric-val">100%</span>
                    <span class="metric-lbl">Verified Costs</span>
                </div>
            </div>
        </div>

        <!-- Right Pane: Cinematic Un-darkened Landscape Photography -->
        <div class="hero-visual-pane">
            <div class="hero-photo-wrapper">
                <img src="{{ asset('images/destinations/bwindi-gorilla-2.webp') }}" 
                     alt="Misty canopy of Bwindi Impenetrable National Park, Uganda" 
                     class="hero-cinematic-img" 
                     id="heroCinematicImg">
                <div class="hero-photo-vignette"></div>

                <!-- Floating Editorial Plaque -->
                <div class="hero-floating-plaque">
                    <div class="plaque-header">
                        <span class="plaque-badge">Primeval Sanctuary</span>
                        <span class="plaque-elevation">Alt: 2,607m</span>
                    </div>
                    <h3 class="plaque-title">Bwindi Impenetrable Forest</h3>
                    <p class="plaque-desc">Ancient UNESCO Afro-montane forest sheltering over 450 wild mountain gorillas amid emerald highland clouds.</p>
                    <a href="{{ route('destinations.show', 'bwindi-impenetrable-np') }}" class="plaque-cta">
                        Explore Bwindi Sanctuary
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>

                <!-- Subtle Photo Switcher Tabs -->
                <div class="hero-photo-nav" aria-label="Featured Landscape Switcher">
                    <button class="hero-tab-btn active" data-img="{{ asset('images/destinations/bwindi-gorilla-2.webp') }}" data-title="Bwindi Impenetrable Forest" data-badge="Primeval Sanctuary" data-desc="Ancient UNESCO Afro-montane forest sheltering over 450 wild mountain gorillas." data-alt="Alt: 2,607m" data-slug="bwindi-impenetrable-np">
                        Bwindi
                    </button>
                    <button class="hero-tab-btn" data-img="{{ asset('images/destinations/murchison-falls.webp') }}" data-title="Murchison Falls National Park" data-badge="The River Nile" data-desc="The world's most powerful waterfall forcing 300,000 litres per second through a 7-metre gorge." data-alt="Alt: 620m" data-slug="murchison-falls-np">
                        Murchison
                    </button>
                    <button class="hero-tab-btn" data-img="{{ asset('images/destinations/lake-bunyonyi.webp') }}" data-title="Lake Bunyonyi Highland" data-badge="29 Emerald Islands" data-desc="Serene bilharzia-free crater lake flanked by terraced hills and mystical dugout canoe trails." data-alt="Alt: 1,962m" data-slug="lake-bunyonyi">
                        Bunyonyi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Down Indicator -->
    <a href="#editorialDestinations" class="hero-scroll-tether" aria-label="Scroll down to discover destinations">
        <span class="scroll-label">Scroll to Explore</span>
        <div class="scroll-mouse-track">
            <div class="scroll-wheel-dot"></div>
        </div>
    </a>
</section>

<!-- ==========================================================================
     2. ASYMMETRICAL MAGAZINE SPREAD: THE ICONIC FIVE
     ========================================================================== -->
<section class="section-editorial-destinations" id="editorialDestinations">
    <div class="container-wide">
        <div class="editorial-section-lead">
            <div class="lead-text-group">
                <span class="editorial-kicker">Curated Destinations</span>
                <h2 class="editorial-headline-serif">Discover places that stay with you long after the journey ends.</h2>
            </div>
            <div class="lead-action">
                <a href="{{ route('destinations') }}" class="editorial-view-all-link">
                    <span>View All 13 Destinations</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>

        <!-- Asymmetrical Magazine Grid (Anchor Portrait + Panoramic Wide + 3 Balanced Tiles) -->
        <div class="magazine-destinations-layout">
            @php
                $highlightMeta = [
                    'bwindi-impenetrable-np' => ['badge' => 'Primate Kingdom', 'sub' => 'Misty Rainforest & Mountain Gorillas', 'region' => 'Southwestern'],
                    'bwindi' => ['badge' => 'Primate Kingdom', 'sub' => 'Misty Rainforest & Mountain Gorillas', 'region' => 'Southwestern'],
                    'murchison-falls-np' => ['badge' => 'The Mighty Nile', 'sub' => 'Savannah Big 5 & Roaring Cataracts', 'region' => 'Northwestern'],
                    'jinja' => ['badge' => 'Adventure Capital', 'sub' => 'Source of the Nile & Class V Rapids', 'region' => 'Eastern'],
                    'sipi-falls' => ['badge' => 'Highland Cascades', 'sub' => 'Triple Waterfalls & Organic Arabica', 'region' => 'Eastern'],
                    'lake-bunyonyi' => ['badge' => 'Highland Serenity', 'sub' => '29 Mystical Islands & Canoe Trails', 'region' => 'Southwestern'],
                ];
                $top5 = $popularDestinations->take(5);
                $anchorItem = $top5->first();
                $panoramicItem = $top5->skip(1)->first();
                $subItems = $top5->skip(2);
            @endphp

            @if($anchorItem)
                @php $aMeta = $highlightMeta[$anchorItem->slug] ?? ['badge' => 'Iconic Sanctuary', 'sub' => 'Authentic Uganda Safari', 'region' => $anchorItem->region]; @endphp
                <!-- Anchor Item: Tall Portrait Format -->
                <div class="mag-card mag-card-anchor">
                    <a href="{{ route('destinations.show', $anchorItem->slug) }}" class="mag-card-inner">
                        <div class="mag-media-box">
                            <img src="{{ asset($anchorItem->image_path ?? 'images/destinations/bwindi-gorilla-1.webp') }}" 
                                 alt="{{ $anchorItem->name }}" 
                                 class="mag-card-img" 
                                 loading="lazy">
                            <div class="mag-overlay-gradient"></div>
                        </div>
                        <div class="mag-content-layer">
                            <div class="mag-tag-row">
                                <span class="mag-badge">{{ $aMeta['badge'] }}</span>
                                <span class="mag-region">{{ $anchorItem->region }} Uganda</span>
                            </div>
                            <h3 class="mag-card-title">{{ $anchorItem->name }}</h3>
                            <p class="mag-card-excerpt">{{ Str::limit($anchorItem->description, 135) }}</p>
                            <div class="mag-card-footer">
                                <div class="mag-price-info">
                                    <span class="mag-price-caption">Starting from</span>
                                    <span class="mag-price-value">@price($anchorItem->estimated_cost_from_kampala)</span>
                                </div>
                                <span class="mag-card-btn">
                                    Explore Sanctuary &rarr;
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            @if($panoramicItem)
                @php $pMeta = $highlightMeta[$panoramicItem->slug] ?? ['badge' => 'Savannah Giant', 'sub' => 'Big 5 Safari & Nile Rapids', 'region' => $panoramicItem->region]; @endphp
                <!-- Panoramic Item: Wide Landscape Format -->
                <div class="mag-card mag-card-panoramic">
                    <a href="{{ route('destinations.show', $panoramicItem->slug) }}" class="mag-card-inner">
                        <div class="mag-media-box">
                            <img src="{{ asset($panoramicItem->image_path ?? 'images/destinations/murchison-falls.webp') }}" 
                                 alt="{{ $panoramicItem->name }}" 
                                 class="mag-card-img" 
                                 loading="lazy">
                            <div class="mag-overlay-gradient"></div>
                        </div>
                        <div class="mag-content-layer">
                            <div class="mag-tag-row">
                                <span class="mag-badge">{{ $pMeta['badge'] }}</span>
                                <span class="mag-region">{{ $panoramicItem->region }} Uganda</span>
                            </div>
                            <h3 class="mag-card-title">{{ $panoramicItem->name }}</h3>
                            <p class="mag-card-excerpt">{{ Str::limit($panoramicItem->description, 140) }}</p>
                            <div class="mag-card-footer">
                                <div class="mag-price-info">
                                    <span class="mag-price-caption">Estimated from</span>
                                    <span class="mag-price-value">@price($panoramicItem->estimated_cost_from_kampala)</span>
                                </div>
                                <span class="mag-card-btn">
                                    Explore Destination &rarr;
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- 3 Balanced Landscape Tiles -->
            <div class="mag-landscape-trio">
                @foreach($subItems as $item)
                    @php $sMeta = $highlightMeta[$item->slug] ?? ['badge' => 'Hidden Wonder', 'sub' => 'Authentic Uganda', 'region' => $item->region]; @endphp
                    <div class="mag-card mag-card-tile">
                        <a href="{{ route('destinations.show', $item->slug) }}" class="mag-card-inner">
                            <div class="mag-media-box">
                                <img src="{{ asset($item->image_path ?? 'images/destinations/lake-bunyonyi.webp') }}" 
                                     alt="{{ $item->name }}" 
                                     class="mag-card-img" 
                                     loading="lazy">
                                <div class="mag-overlay-gradient"></div>
                            </div>
                            <div class="mag-content-layer">
                                <div class="mag-tag-row">
                                    <span class="mag-badge">{{ $sMeta['badge'] }}</span>
                                    <span class="mag-region">{{ $item->region }}</span>
                                </div>
                                <h3 class="mag-card-title">{{ $item->name }}</h3>
                                <div class="mag-card-footer">
                                    <span class="mag-price-value">@price($item->estimated_cost_from_kampala)</span>
                                    <span class="mag-arrow-disc" aria-hidden="true">&rarr;</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     3. THE INTELLIGENT METHOD (Editorial 3-Stage Process)
     ========================================================================== -->
<section class="section-editorial-process">
    <div class="container">
        <div class="process-editorial-header">
            <span class="editorial-kicker">Intelligent Concierge</span>
            <h2 class="editorial-headline-serif">How Pearl Trails Works</h2>
            <p class="process-sublead">
                Unlike generic booking sites, Pearl Trails calculates real Uganda highway logistics, vehicle fuel consumption, and park fees tailored to your exact budget in {{ $currentCurrency }}.
            </p>
        </div>

        <div class="process-timeline-track">
            <div class="process-step-panel">
                <div class="step-numeral-editorial">01</div>
                <div class="step-details">
                    <span class="step-category">Step One</span>
                    <h3 class="step-headline">Select Starting Point & Scope</h3>
                    <p class="step-body">
                        Choose your departure town in Uganda (Kampala, Entebbe, Jinja, Mbale, or Mbarara), travel dates, party size, and comfortable spending limit in {{ $currentCurrency }}.
                    </p>
                </div>
            </div>

            <div class="process-step-panel">
                <div class="step-numeral-editorial">02</div>
                <div class="step-details">
                    <span class="step-category">Step Two</span>
                    <h3 class="step-headline">Algorithmic Compatibility Match</h3>
                    <p class="step-body">
                        Our engine evaluates road driving hours, Uganda Wildlife Authority park fees, accommodation tariffs, and fuel multipliers to match you with top 3 compatible destinations.
                    </p>
                </div>
            </div>

            <div class="process-step-panel">
                <div class="step-numeral-editorial">03</div>
                <div class="step-details">
                    <span class="step-category">Step Three</span>
                    <h3 class="step-headline">Customize & Live Navigation</h3>
                    <p class="step-body">
                        Handpick safari lodges, dining spots, and day activities with our real-time budget builder. Open turnkey Google Maps driving routes and save your itinerary.
                    </p>
                </div>
            </div>
        </div>

        <div class="process-cta-wrap">
            <a href="{{ route('plan') }}" class="btn-luxury-gold">
                <span>Start Interactive Safari Wizard</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. FULL-WIDTH PHOTOGRAPHIC FEATURE: INTO THE WILD
     ========================================================================== -->
<section class="section-fullbleed-feature">
    <div class="feature-photo-backdrop">
        <img src="{{ asset('images/destinations/queen-elizabeth-kazinga.webp') }}" 
             alt="Kazinga Channel wildlife in Queen Elizabeth National Park" 
             class="feature-backdrop-img" 
             loading="lazy">
        <div class="feature-backdrop-gradient"></div>
    </div>

    <div class="container">
        <div class="feature-editorial-dossier">
            <div class="dossier-card">
                <span class="dossier-kicker">Winston Churchill &bull; 1907</span>
                <blockquote class="dossier-quote">
                    “Uganda is truly the Pearl of Africa. For magnificence, for variety of form and colour, for profusion of brilliant life — bird, insect, reptile, beast — for vast scale... Uganda is truly all of them.”
                </blockquote>
                <div class="dossier-stats-grid">
                    <div class="dossier-stat">
                        <span class="stat-big">1,060+</span>
                        <span class="stat-caption">Avian Species (11% of Global Total)</span>
                    </div>
                    <div class="dossier-stat">
                        <span class="stat-big">345+</span>
                        <span class="stat-caption">Mammal Species in Diverse Habitats</span>
                    </div>
                    <div class="dossier-stat">
                        <span class="stat-big">3</span>
                        <span class="stat-caption">UNESCO World Heritage Sites</span>
                    </div>
                </div>
                <div class="dossier-action">
                    <a href="{{ route('guide') }}" class="btn-luxury-gold">
                        <span>Read Uganda Travel Guide</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     5. CURATED SAFARI LODGES & RETREATS (Boutique Accommodation)
     ========================================================================== -->
<section class="section-editorial-stays">
    <div class="container-wide">
        <div class="editorial-section-lead">
            <div class="lead-text-group">
                <span class="editorial-kicker">Where to Stay</span>
                <h2 class="editorial-headline-serif">Curated Safari Lodges, Camps & Eco Retreats</h2>
                <p class="editorial-lead-sub">From luxury ridge-top tented suites over the Nile to serene lakeside wooden chalets, discover authentic Ugandan stays.</p>
            </div>
            <div class="lead-action">
                <a href="{{ route('stays') }}" class="editorial-view-all-link">
                    <span>Explore All Accommodations</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>

        <div class="curated-lodges-grid">
            @foreach($featuredStays->take(3) as $index => $stay)
                <article class="lodge-editorial-card">
                    <div class="lodge-media-frame">
                        <img src="{{ asset($stay->image_path ?? 'images/destinations/bwindi-gorilla-1.webp') }}" 
                             alt="{{ $stay->name }}" 
                             class="lodge-img" 
                             loading="lazy">
                        <span class="lodge-badge-pill">{{ $stay->type ?? 'Safari Lodge' }}</span>
                    </div>
                    <div class="lodge-body-dossier">
                        <div class="lodge-region-tag">{{ $stay->destination->name ?? 'Uganda' }}</div>
                        <h3 class="lodge-title">{{ $stay->name }}</h3>
                        <p class="lodge-narrative">{{ Str::limit($stay->description, 115) }}</p>
                        <div class="lodge-rate-row">
                            <div class="rate-stack">
                                <span class="rate-value">@price($stay->price_ugx)</span>
                                <span class="rate-unit">per {{ $stay->unit }}</span>
                            </div>
                            <div class="lodge-links-stack">
                                @if($stay->website)
                                    <a href="{{ $stay->website }}" target="_blank" rel="noopener noreferrer" class="lodge-ext-link">
                                        Website ↗
                                    </a>
                                @else
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($stay->name . ', ' . ($stay->destination->name ?? 'Uganda') . ', Uganda') }}" target="_blank" rel="noopener noreferrer" class="lodge-ext-link">
                                        Google Maps ↗
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     6. CURATED ADVENTURES & FIELD EXPERIENCES
     ========================================================================== -->
<section class="section-field-experiences">
    <div class="container-wide">
        <div class="editorial-section-lead">
            <div class="lead-text-group">
                <span class="editorial-kicker">Field Experiences</span>
                <h2 class="editorial-headline-serif">Find Your Kind of Adventure</h2>
            </div>
            <div class="lead-action">
                <a href="{{ route('interest') }}" class="editorial-view-all-link">
                    <span>Explore All Experiences</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>

        <div class="experiences-quad-grid">
            @foreach($experiences as $exp)
                <a href="{{ route('interest', ['interest' => strtolower($exp['interest'])]) }}" class="experience-editorial-tile">
                    <div class="exp-tile-media">
                        <img src="{{ asset($exp['image']) }}" alt="{{ $exp['title'] }}" class="exp-tile-img" loading="lazy">
                        <div class="exp-tile-overlay"></div>
                    </div>
                    <div class="exp-tile-info">
                        <span class="exp-tag-label">{{ $exp['tag'] }}</span>
                        <h3 class="exp-tile-headline">{{ $exp['title'] }}</h3>
                        <p class="exp-tile-summary">{{ $exp['desc'] }}</p>
                        <span class="exp-tile-action">
                            Explore {{ $exp['interest'] }} Safaris &rarr;
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     7. DAY ADVENTURES & RECREATION CENTRES
     ========================================================================== -->
<section class="section-editorial-recreation">
    <div class="container-wide">
        <div class="editorial-section-lead">
            <div class="lead-text-group">
                <span class="editorial-kicker">Recreation & Activities</span>
                <h2 class="editorial-headline-serif">Adventure Spots & Day Excursions</h2>
            </div>
            <div class="lead-action">
                <a href="{{ route('recreation') }}" class="editorial-view-all-link">
                    <span>Browse All Activities</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>

        <div class="recreation-strip-grid">
            @foreach($recreationStrip as $rec)
                <article class="rec-editorial-tile">
                    @if(!empty($rec->image_path))
                        <div class="rec-tile-image-box">
                            <img src="{{ asset($rec->image_path) }}?v={{ @filemtime(public_path($rec->image_path)) ?: '1' }}" 
                                 alt="{{ $rec->name }}" 
                                 class="rec-tile-img" 
                                 loading="lazy">
                        </div>
                    @endif
                    <div class="rec-tile-body">
                        <span class="rec-location-tag">{{ $rec->destination->name ?? 'Uganda' }}</span>
                        <h4 class="rec-tile-name">{{ $rec->name }}</h4>
                        <div class="rec-tile-price">
                            <span class="price-figure">@price($rec->price_ugx)</span>
                            <span class="price-basis">per {{ $rec->unit }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     8. TRANSPARENT BUDGET EXPLORER
     ========================================================================== -->
<section class="section-editorial-budget">
    <div class="container">
        <div class="process-editorial-header">
            <span class="editorial-kicker">Transparent Travel Tiers</span>
            <h2 class="editorial-headline-serif">Explore Destinations by Budget</h2>
            <p class="process-sublead">
                Every Uganda traveler has a distinct comfort zone. Discover curated itineraries matched precisely to your budget tier in {{ $currentCurrency }}.
            </p>
        </div>

        <div class="budget-tiers-triptych">
            @foreach($budgetBands as $band)
                <a href="{{ route('destinations', ['budget_band' => $band['id']]) }}" class="budget-tier-card">
                    <span class="tier-badge">{{ $band['name'] ?? 'Tier' }}</span>
                    <div class="tier-cost-range">{{ $band['label'] }}</div>
                    <p class="tier-explanation">Matched to vetted lodges, park entry fees, vehicle transport, and authentic cultural activities.</p>
                    <span class="tier-cta-link">
                        Explore Matching Trips &rarr;
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     9. BRAND MANIFESTO & THE FOUR PILLARS
     ========================================================================== -->
<section class="section-brand-manifesto">
    <div class="container">
        <div class="manifesto-split-grid">
            <!-- Left: Brand Manifesto -->
            <div class="manifesto-prose">
                <span class="editorial-kicker">The Pearl Trails Manifesto</span>
                <h2 class="editorial-headline-serif">Uganda, Unfiltered &amp; Unforgettable.</h2>
                <p class="manifesto-body">
                    We founded Pearl Trails to solve a fundamental challenge in East African travel: obscurity. Too often, visitors are met with opaque safari quotes, hidden park tariffs, and disconnected travel itineraries.
                </p>
                <p class="manifesto-body">
                    Pearl Trails bridges the gap. We provide real travel distances, verified local accommodation and dining pricing, live Google Maps route navigation, and intelligent multi-party budget estimation.
                </p>
                <div class="manifesto-author-block">
                    <div class="author-title">The Pearl Trails Editorial Collective</div>
                    <div class="author-location">Kampala &bull; Jinja &bull; Fort Portal</div>
                </div>
            </div>

            <!-- Right: The 4 Pillars -->
            <div class="manifesto-pillars-grid">
                <div class="pillar-card">
                    <div class="pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Transparent Costing</h3>
                    <p class="pillar-desc">No hidden commissions. Clear itemized estimates for transport, park entry, lodging, and activities.</p>
                </div>

                <div class="pillar-card">
                    <div class="pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Direct Local Partners</h3>
                    <p class="pillar-desc">Empowering local Ugandan lodge keepers, community guides, and culinary artisans directly.</p>
                </div>

                <div class="pillar-card">
                    <div class="pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                            <line x1="8" y1="2" x2="8" y2="18"></line>
                            <line x1="16" y1="6" x2="16" y2="22"></line>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Live Highway Navigation</h3>
                    <p class="pillar-desc">Integrated Google Maps driving directions and GPS coordinates for all 155+ points of interest.</p>
                </div>

                <div class="pillar-card">
                    <div class="pillar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                        </svg>
                    </div>
                    <h3 class="pillar-title">Multi-Currency Engine</h3>
                    <p class="pillar-desc">Live switching between UGX, USD, EUR, and GBP with real-time conversion across all 155 venues.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     10. CONCIERGE TRIP PLANNING WIZARD BANNER
     ========================================================================== -->
<section class="section-wizard-banner">
    <div class="container">
        <div class="wizard-editorial-callout">
            <div class="callout-narrative">
                <span class="callout-badge">Bespoke Safari Concierge</span>
                <h2 class="callout-headline">Ready to craft your tailor-made Uganda journey?</h2>
                <p class="callout-desc">
                    Answer 7 brief questions regarding your departure town, travel group, preferred pace, and target budget. Our algorithm computes exact driving distances and generates your optimal itinerary.
                </p>
            </div>
            <div class="callout-action-col">
                <a href="{{ route('plan') }}" class="btn-luxury-gold btn-lg">
                    <span>Start Safari Wizard</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Hero Photo Switcher Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabBtns = document.querySelectorAll('.hero-tab-btn');
        const heroImg = document.getElementById('heroCinematicImg');
        const plaque = document.querySelector('.hero-floating-plaque');
        
        if (tabBtns.length && heroImg && plaque) {
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    tabBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    
                    const imgUrl = btn.getAttribute('data-img');
                    const title = btn.getAttribute('data-title');
                    const badge = btn.getAttribute('data-badge');
                    const desc = btn.getAttribute('data-desc');
                    const alt = btn.getAttribute('data-alt');
                    const slug = btn.getAttribute('data-slug');
                    
                    heroImg.style.opacity = '0.3';
                    setTimeout(() => {
                        heroImg.src = imgUrl;
                        heroImg.style.opacity = '1';
                        
                        const titleEl = plaque.querySelector('.plaque-title');
                        const badgeEl = plaque.querySelector('.plaque-badge');
                        const descEl = plaque.querySelector('.plaque-desc');
                        const altEl = plaque.querySelector('.plaque-elevation');
                        const linkEl = plaque.querySelector('.plaque-cta');
                        
                        if (titleEl) titleEl.textContent = title;
                        if (badgeEl) badgeEl.textContent = badge;
                        if (descEl) descEl.textContent = desc;
                        if (altEl) altEl.textContent = alt;
                        if (linkEl) linkEl.href = '/destinations/' + slug;
                    }, 200);
                });
            });
        }
    });
</script>
@endsection