@extends('layouts.app')
@section('title', 'Pearl Trails — Discover Uganda. Feel Alive.')
@section('meta_description', 'Discover Uganda with Pearl Trails. From mist-covered gorilla mountains and the roaring River Nile to serene crater lakes and transparent safari budget planning.')

@section('content')
<!-- ==========================================================================
     1. CINEMATIC HERO SECTION
     ========================================================================== -->
<section class="hero-editorial" id="heroSection">
    <div class="hero-overlay-dark"></div>
    <div class="hero-content">
        <span class="hero-pill-label">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle;">
                <circle cx="12" cy="12" r="10"></circle>
                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
            </svg>
            The Pearl of Africa — Your Uganda. Your Budget. Your Adventure.
        </span>

        <h1 class="hero-main-title">
            Discover Uganda.<br>
            <span class="hero-gold-italic">Feel Alive.</span>
        </h1>

        <p class="hero-lead-text">
            From mist-covered mountains and breathtaking wildlife to hidden lakes and unforgettable adventures, discover the magic of the Pearl of Africa.
        </p>

        <div class="hero-cta-group">
            <a href="{{ route('destinations') }}" class="btn btn-gold btn-lg">
                Explore Uganda
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
            <a href="{{ route('plan') }}" class="btn btn-outline-white btn-lg">
                Plan Your Adventure
            </a>
        </div>

        <a href="#destinationPreview" class="hero-scroll-indicator" aria-label="Scroll down to explore">
            <div class="scroll-mouse-icon">
                <div class="scroll-mouse-wheel"></div>
            </div>
            <span>Scroll To Explore</span>
        </a>
    </div>
</section>

<!-- ==========================================================================
     2. DESTINATION PREVIEW SECTION (Warm Ivory Editorial)
     ========================================================================== -->
<section class="section-editorial-preview topo-pattern" id="destinationPreview">
    <div class="container">
        <div class="editorial-header-row">
            <div>
                <span class="editorial-tag">Iconic Landscapes</span>
                <h2 class="editorial-title">Discover places that stay with you long after the journey ends.</h2>
            </div>
            <a href="{{ route('destinations') }}" class="btn btn-outline">
                View All 13 Destinations →
            </a>
        </div>

        <div class="preview-dest-grid">
            @php
                // Map the 5 highlight destinations
                $highlightSlugs = [
                    'bwindi-impenetrable-np' => ['class' => 'preview-dest-card-lg', 'tag' => 'Misty Rainforest & Gorillas'],
                    'bwindi' => ['class' => 'preview-dest-card-lg', 'tag' => 'Misty Rainforest & Gorillas'],
                    'murchison-falls-np' => ['class' => 'preview-dest-card-lg', 'tag' => 'The Mighty Nile & Savannah Big 5'],
                    'jinja' => ['class' => 'preview-dest-card-sm', 'tag' => 'Source of the Nile & Adventure'],
                    'sipi-falls' => ['class' => 'preview-dest-card-sm', 'tag' => 'Triple Cascades & Arabica Coffee'],
                    'lake-bunyonyi' => ['class' => 'preview-dest-card-sm', 'tag' => '29 Islands & Highland Serenity'],
                ];
                $previewItems = $popularDestinations->take(5);
            @endphp

            @foreach($previewItems as $index => $dest)
                @php
                    $isLarge = ($index < 2);
                    $meta = $highlightSlugs[$dest->slug] ?? ['tag' => 'Iconic Landmark'];
                @endphp
                <a href="{{ route('destinations.show', $dest->slug) }}" class="preview-dest-card {{ $isLarge ? 'preview-dest-card-lg' : 'preview-dest-card-sm' }}">
                    <img src="{{ asset($dest->image_path ?? 'images/destinations/bwindi-gorilla-1.webp') }}" alt="{{ $dest->name }}" class="preview-card-bg" loading="lazy">
                    <div class="preview-card-gradient"></div>
                    <div class="preview-card-content">
                        <div class="preview-card-badges">
                            <span class="glass-badge">{{ $dest->region }} Uganda</span>
                            <span class="glass-badge glass-badge-gold">{{ $meta['tag'] }}</span>
                        </div>
                        <h3 class="preview-card-name">{{ $dest->name }}</h3>
                        <p class="preview-card-desc">{{ Str::limit($dest->description, $isLarge ? 130 : 90) }}</p>
                        <div class="preview-card-footer">
                            <div class="preview-price-box">
                                <span class="preview-price-label">Estimated from</span>
                                <span class="preview-price-val">@price($dest->estimated_cost_from_kampala)</span>
                            </div>
                            <span class="preview-arrow-btn">
                                Explore
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     3. HOW IT WORKS (3-Step Editorial Process)
     ========================================================================== -->
<section class="section-process">
    <div class="container">
        <div class="editorial-header-row" style="text-align: center; justify-content: center; flex-direction: column; align-items: center; margin-bottom: 3.5rem;">
            <span class="editorial-tag">Intelligent Trip Planning</span>
            <h2 class="editorial-title" style="text-align: center;">How Pearl Trails Works</h2>
            <p style="color: var(--text-muted); max-width: 600px; margin-top: 0.5rem;">
                Effortless safari and travel planning designed specifically for Uganda's diverse terrain and travel styles.
            </p>
        </div>

        <div class="process-grid">
            <div class="process-step-card">
                <div class="process-step-num">01</div>
                <h3 class="process-step-title">Share Your Parameters</h3>
                <p class="process-step-desc">
                    Tell us your starting town in Uganda (Kampala, Entebbe, Jinja, Mbale, or Mbarara), available days, travel party, and comfortable budget in {{ $currentCurrency }}.
                </p>
            </div>

            <div class="process-step-card">
                <div class="process-step-num">02</div>
                <h3 class="process-step-title">Smart Compatibility Match</h3>
                <p class="process-step-desc">
                    Our algorithm analyzes highway distances, real vehicle fuel costs, park entry fees, and comfort multipliers to match you with your top three compatible destinations.
                </p>
            </div>

            <div class="process-step-card">
                <div class="process-step-num">03</div>
                <h3 class="process-step-title">Customize & Travel</h3>
                <p class="process-step-desc">
                    Pick your favorite lodges, restaurants, and recreation activities with our live budget builder, view exact Google Maps driving routes, and save your custom itinerary.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. DISCOVER UGANDA BY EXPERIENCE ("Find Your Kind of Adventure")
     ========================================================================== -->
<section class="section-experiences topo-pattern">
    <div class="container">
        <div class="editorial-header-row">
            <div>
                <span class="editorial-tag">Curated Activities</span>
                <h2 class="editorial-title">Find Your Kind of Adventure</h2>
            </div>
            <a href="{{ route('interest') }}" class="btn btn-outline">
                Explore All Experiences →
            </a>
        </div>

        <div class="experiences-grid">
            @foreach($experiences as $exp)
                <a href="{{ route('interest', ['interest' => strtolower($exp['interest'])]) }}" class="experience-card">
                    <div class="experience-media">
                        <img src="{{ asset($exp['image']) }}" alt="{{ $exp['title'] }}" class="experience-img" loading="lazy">
                        <span class="experience-tag-pill">{{ $exp['tag'] }}</span>
                    </div>
                    <div class="experience-body">
                        <h3 class="experience-title">{{ $exp['title'] }}</h3>
                        <p class="experience-desc">{{ $exp['desc'] }}</p>
                        <span class="experience-link">
                            Explore {{ $exp['interest'] }} Trips →
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     5. POPULAR RECREATION CENTRES & ADVENTURE SPOTS
     ========================================================================== -->
<section class="section-recreation-preview">
    <div class="container">
        <div class="editorial-header-row">
            <div>
                <span class="editorial-tag">Activities & Fun</span>
                <h2 class="editorial-title">Recreation Centres & Day Adventures</h2>
            </div>
            <a href="{{ route('recreation') }}" class="btn btn-outline">
                View All Recreation Centres →
            </a>
        </div>

        <div class="recreation-carousel-grid">
            @foreach($recreationStrip as $rec)
                <div class="rec-card-item">
                    @if(!empty($rec->image_path))
                        <div class="rec-card-media">
                            <img src="{{ asset($rec->image_path) }}?v={{ @filemtime(public_path($rec->image_path)) ?: '1' }}" alt="{{ $rec->name }}" class="rec-card-img" loading="lazy">
                        </div>
                    @endif
                    <div class="rec-card-content">
                        <span class="rec-dest-label">{{ $rec->destination->name ?? 'Uganda' }}</span>
                        <h4 class="rec-item-name">{{ $rec->name }}</h4>
                        <div class="rec-price-box">
                            <span class="rec-price-val">@price($rec->price_ugx)</span>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">per {{ $rec->unit }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     6. FEATURED ACCOMMODATION & SAFARI LODGES
     ========================================================================== -->
<section class="section-accommodation-preview topo-pattern">
    <div class="container">
        <div class="editorial-header-row">
            <div>
                <span class="editorial-tag">Where to Stay</span>
                <h2 class="editorial-title">Curated Lodges, Camps & Retreats</h2>
            </div>
            <a href="{{ route('stays') }}" class="btn btn-outline">
                Browse All Accommodation →
            </a>
        </div>

        <div class="lodge-cards-grid">
            @foreach($featuredStays as $stay)
                <div class="lodge-card">
                    <div class="lodge-card-media">
                        <img src="{{ asset($stay->image_path ?? 'images/destinations/bwindi-gorilla-1.webp') }}" alt="{{ $stay->name }}" class="lodge-card-img" loading="lazy">
                        <span class="lodge-style-badge">{{ $stay->type ?? 'Lodge' }}</span>
                    </div>
                    <div class="lodge-card-body">
                        <span class="lodge-location">{{ $stay->destination->name ?? 'Uganda' }}</span>
                        <h3 class="lodge-name">{{ $stay->name }}</h3>
                        <p class="lodge-desc">{{ Str::limit($stay->description, 110) }}</p>
                        <div class="lodge-card-footer">
                            <div class="browse-price-box">
                                <span class="browse-price-val">@price($stay->price_ugx)</span>
                                <span class="browse-price-unit">per {{ $stay->unit }}</span>
                            </div>
                            @if($stay->website)
                                <a href="{{ $stay->website }}" target="_blank" rel="noopener noreferrer" class="browse-action-link">
                                    Website ↗
                                </a>
                            @else
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($stay->name . ', ' . ($stay->destination->name ?? 'Uganda') . ', Uganda') }}" target="_blank" rel="noopener noreferrer" class="browse-action-link">
                                    View on Maps ↗
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     7. BUDGET EXPLORER
     ========================================================================== -->
<section class="section-budget-explorer">
    <div class="container">
        <div class="editorial-header-row" style="text-align: center; justify-content: center; flex-direction: column; align-items: center; margin-bottom: 3.5rem;">
            <span class="editorial-tag">Transparent Spending</span>
            <h2 class="editorial-title" style="text-align: center;">Explore by Your Budget Tier</h2>
            <p style="color: var(--text-muted); max-width: 600px; margin-top: 0.5rem;">
                Browse Uganda safari and getaway destinations matched to your target spending comfort zone in {{ $currentCurrency }}.
            </p>
        </div>

        <div class="budget-bands-grid">
            @foreach($budgetBands as $band)
                <a href="{{ route('destinations', ['budget_band' => $band['id']]) }}" class="budget-band-card">
                    <span class="budget-band-amount">{{ $band['label'] }}</span>
                    <span class="budget-band-label">Filter adventures and safari lodges matched to this bracket.</span>
                    <span class="budget-band-cta">Explore Trips →</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     8. WHY EXPLORE UGANDA WITH PEARL TRAILS
     ========================================================================== -->
<section class="section-why-us">
    <div class="container">
        <div class="editorial-header-row" style="text-align: center; justify-content: center; flex-direction: column; align-items: center; margin-bottom: 3.5rem;">
            <span class="editorial-tag">The Pearl Trails Promise</span>
            <h2 class="editorial-title" style="text-align: center;">Why Explore With Pearl Trails</h2>
            <p style="color: var(--text-muted); max-width: 640px; margin-top: 0.5rem;">
                Built to make domestic and international travel across Uganda transparent, authentic, and beautifully organized.
            </p>
        </div>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon-wrap">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3 class="why-card-title">Transparent Cost Breakdowns</h3>
                <p class="why-card-desc">
                    Never wonder what a Uganda safari actually costs. We calculate realistic accommodation, park fees, fuel, and meals with verified pricing.
                </p>
            </div>

            <div class="why-card">
                <div class="why-icon-wrap">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="why-card-title">Community-Backed Listings</h3>
                <p class="why-card-desc">
                    Local lodges, experienced safari guides, authentic restaurants, and cultural initiatives are showcased directly without intermediary markups.
                </p>
            </div>

            <div class="why-card">
                <div class="why-icon-wrap">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                    </svg>
                </div>
                <h3 class="why-card-title">Multi-Currency Flexibility</h3>
                <p class="why-card-desc">
                    Switch effortlessly between UGX, USD, EUR, and GBP with live approximate currency conversions so you always know your exact expenditure.
                </p>
            </div>

            <div class="why-card">
                <div class="why-icon-wrap">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                        <line x1="8" y1="2" x2="8" y2="18"></line>
                        <line x1="16" y1="6" x2="16" y2="22"></line>
                    </svg>
                </div>
                <h3 class="why-card-title">Curated for Every Travel Style</h3>
                <p class="why-card-desc">
                    From solo backpackers on public coaches to couples in luxury fly-in tented camps, our smart engine adapts recommendations to your preferred pace.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     9. INTERACTIVE TRIP PLANNING WIZARD CTA
     ========================================================================== -->
<section class="section-cta-banner">
    <div class="container">
        <div class="cta-banner-box">
            <div class="cta-banner-text">
                <span class="glass-badge glass-badge-gold" style="margin-bottom: 1rem;">Smart Recommendation Engine</span>
                <h2 class="cta-banner-title">Ready to build your personalized Uganda adventure?</h2>
                <p class="cta-banner-desc">
                    Answer 7 quick questions about your starting location, travel duration, group, and budget. Our algorithm calculates road distances, lodging costs, and recommends your best trip match.
                </p>
            </div>
            <div>
                <a href="{{ route('plan') }}" class="btn btn-gold btn-lg">
                    Start Trip Planner Wizard
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
