@extends('layouts.app')
@section('title', 'Your Uganda. Your Budget. Your Adventure. - Pearl Trails')

@section('content')
<div class="home-container">

    <!-- 1. HERO SECTION -->
    <section class="home-hero">
        <div class="hero-badge-tag">The Tourism Decision Assistant for Uganda</div>
        <h1 class="hero-main-heading">Your Uganda. Your Budget. Your Adventure.</h1>
        <p class="hero-subtext">
            Discover breathtaking national parks, misty gorilla forests, and tranquil island hideaways tailored precisely to your budget, time, and travel style.
        </p>
        <div class="hero-cta-group">
            <a href="{{ route('plan') }}" class="btn btn-gold btn-hero">
                Find My Perfect Trip
            </a>
            <a href="{{ route('destinations') }}" class="btn btn-outline btn-hero">
                Browse All Destinations
            </a>
        </div>
        <div class="hero-micro-notes">
            <span>✓ No hidden costs</span>
            <span>✓ Real road distance metrics</span>
            <span>✓ Community vendor verified</span>
        </div>
    </section>

    <!-- 2. HOW IT WORKS (3 STEPS) -->
    <section class="home-section">
        <div class="section-header-centered">
            <span class="quiz-badge">Simple 3-Step Process</span>
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Effortless travel planning designed specifically for Uganda's diverse landscapes.</p>
        </div>

        <div class="how-it-works-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <h3>Share Your Parameters</h3>
                <p>Tell us your starting town in Uganda, available days, companions, and target budget in {{ $currentCurrency }}.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                </div>
                <h3>Smart Compatibility Match</h3>
                <p>Our algorithm factors road mileage, fuel tariffs, park fees, and style multipliers to rank your top 3 destinations.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
                <h3>Customize & Travel</h3>
                <p>Pick where to stay, eat, and have fun with our live budget builder and save custom itineraries for your trip.</p>
            </div>
        </div>
    </section>

    <!-- 3. POPULAR DESTINATIONS (Jinja, Murchison, Bwindi, Sipi, Bunyonyi, Ssese) -->
    <section class="home-section">
        <div class="section-header-between">
            <div>
                <span class="quiz-badge">Traveler Favorites</span>
                <h2 class="section-title">Popular Destinations</h2>
                <p class="section-subtitle">Uganda's six most celebrated safari, mountain, and waterside landmarks.</p>
            </div>
            <a href="{{ route('destinations') }}" class="link-arrow">View All 13 Destinations →</a>
        </div>

        <div class="destinations-grid">
            @foreach($popularDestinations as $dest)
                <div class="dest-card">
                    <div class="dest-card-media">
                        @if(!empty($dest->image_path))
                            <img src="{{ asset($dest->image_path) }}" alt="{{ $dest->name }}" class="dest-card-img" loading="lazy">
                        @else
                            <x-scene-svg :destination="$dest" height="200px" />
                        @endif
                        <span class="region-badge">{{ $dest->region }} Uganda</span>
                        <span class="duration-badge">{{ $dest->min_days }}-{{ $dest->max_days }} Days</span>
                    </div>

                    <div class="dest-card-body">
                        <h3 class="dest-title">{{ $dest->name }}</h3>
                        <p class="dest-desc">{{ Str::limit($dest->description, 110) }}</p>

                        <div class="interest-tags-row">
                            @foreach(array_slice($dest->interests ?? [], 0, 3) as $tag)
                                <span class="tag-pill">{{ $tag }}</span>
                            @endforeach
                        </div>

                        <div class="dest-card-footer">
                            <div class="dest-price-box">
                                <span class="price-label">From</span>
                                <span class="price-amount">@price($dest->estimated_cost_from_kampala)</span>
                            </div>
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="btn btn-sm btn-primary">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 4. RECREATION CENTRES STRIP -->
    <section class="home-section recreation-strip-section">
        <div class="section-header-between">
            <div>
                <span class="quiz-badge">Activities & Entertainment</span>
                <h2 class="section-title">Recreation Centres & Adventure Spots</h2>
                <p class="section-subtitle">High ropes, river tubing, abseiling, boat cruises, and cultural showcases.</p>
            </div>
            <a href="{{ route('recreation') }}" class="btn btn-outline">
                Explore All Recreation Centres →
            </a>
        </div>

        <div class="rec-strip-scroll">
            @foreach($recreationStrip as $rec)
                <div class="rec-strip-card">
                    @if(!empty($rec->image_path))
                        <div class="rec-strip-media">
                            <img src="{{ asset($rec->image_path) }}" alt="{{ $rec->name }}" class="rec-strip-img" loading="lazy">
                        </div>
                    @endif
                    <div class="rec-strip-top">
                        <span class="rec-type-badge">{{ $rec->type ?? 'Activity' }}</span>
                        <span class="rec-location-text">{{ $rec->destination->name ?? 'Uganda' }}</span>
                    </div>
                    <h4>{{ $rec->name }}</h4>
                    <div class="rec-strip-price">
                        <strong>@price($rec->price_ugx)</strong>
                        <span>per {{ $rec->unit }}</span>
                    </div>
                    <a href="{{ route('recreation', ['destination' => $rec->destination_id]) }}" class="rec-card-link">
                        Find in {{ $rec->destination->name ?? 'Uganda' }} →
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 5. EXPLORE BY INTEREST CHIPS -->
    <section class="home-section">
        <div class="section-header-centered">
            <span class="quiz-badge">Curated Experiences</span>
            <h2 class="section-title">Explore by Interest</h2>
            <p class="section-subtitle">Filter Uganda destinations according to what moves you most.</p>
        </div>

        <div class="interest-chips-flex">
            @foreach($interestChips as $chip)
                <a href="{{ route('interest', ['interest' => strtolower($chip)]) }}" class="interest-chip-btn">
                    <span class="chip-label">{{ $chip }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- 6. BUDGET EXPLORER TILES -->
    <section class="home-section">
        <div class="section-header-centered">
            <span class="quiz-badge">Financial Fit</span>
            <h2 class="section-title">Budget Explorer</h2>
            <p class="section-subtitle">Browse destinations matched to your spending comfort zone in {{ $currentCurrency }}.</p>
        </div>

        <div class="budget-explorer-grid">
            @foreach($budgetBands as $band)
                <a href="{{ route('destinations', ['budget_band' => $band['id']]) }}" class="budget-tile">
                    <div class="budget-tile-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </div>
                    <h3 class="budget-tile-title">{{ $band['label'] }}</h3>
                    <p class="budget-tile-desc">Filter suitable getaways within this budget bracket.</p>
                    <span class="budget-tile-arrow">Explore Trips →</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- 7. WHY USE PEARL TRAILS -->
    <section class="home-section why-use-section">
        <div class="section-header-centered">
            <span class="quiz-badge">The Pearl Trails Promise</span>
            <h2 class="section-title">Why Use Pearl Trails</h2>
            <p class="section-subtitle">Built with love and precision to make domestic and international tourism in Uganda transparent and accessible.</p>
        </div>

        <div class="why-us-grid">
            <div class="why-card">
                <div class="why-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3>Transparent Cost Breakdowns</h3>
                <p>Never wonder how much a safari truly costs. We itemize transport, accommodation, food, and activities with honest estimations.</p>
            </div>

            <div class="why-card">
                <div class="why-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3>Community-Backed Listings</h3>
                <p>Verified local hotels, guides, restaurants, and eco-initiatives connect directly with travelers without unfair intermediary markups.</p>
            </div>

            <div class="why-card">
                <div class="why-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <h3>Multi-Currency Flexibility</h3>
                <p>Switch seamlessly between UGX, USD, EUR, and GBP with real-time approximate conversions so you know where every shilling or dollar goes.</p>
            </div>

            <div class="why-card">
                <div class="why-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                </div>
                <h3>Curated for Every Travel Style</h3>
                <p>From solo backpackers on public transport to luxury honeymoon safaris, our engine adapts recommendations to your preferred comfort tier.</p>
            </div>
        </div>
    </section>

</div>
@endsection
