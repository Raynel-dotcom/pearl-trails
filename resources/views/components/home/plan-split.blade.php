@props([
    'destinationsCount' => 13,
    'placesToStayCount' => 39,
    'experiencesCount' => 42,
    'hasVideo' => false
])

<section class="section-plan-split" aria-label="Plan Your Trip">
    <div class="plan-split-container">
        <!-- Left Half: Scenic Lake with Diagonal Cut & Script Overlay -->
        <div class="plan-split-media-col">
            @php
                $lakeImg = 'images/sections/plan-lake-bunyonyi.webp';
                if (!file_exists(public_path($lakeImg))) {
                    $lakeImg = 'images/destinations/lake-bunyonyi.webp';
                }
            @endphp
            @if(file_exists(public_path($lakeImg)))
                <img src="{{ asset($lakeImg) }}" 
                     alt="Lake Bunyonyi Islands" 
                     class="plan-split-bg-img" 
                     loading="lazy" 
                     width="640" height="460">
            @else
                <div class="plan-split-bg-img" style="background: linear-gradient(135deg, var(--forest-2), var(--forest));"></div>
            @endif

            <div class="plan-split-overlay" aria-hidden="true"></div>

            <div class="plan-script-badge">
                <div class="script-text">
                    Your Journey<br>Our Priority
                </div>
                @if($hasVideo)
                    <button type="button" class="btn-plan-video" id="openPlanVideoBtn" aria-label="Watch Video">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <span>Watch Video</span>
                    </button>
                @endif
            </div>
        </div>

        <!-- Right Half: Pitch and Dynamic DB Stats -->
        <div class="plan-split-content-col">
            <span class="section-kicker-gold">Plan Your Trip</span>
            <h2 class="section-title-serif">Your Journey. Your Budget. Your Uganda.</h2>
            <p class="plan-lead-copy">
                Let us help you create the perfect travel experience, tailored to your interests, budget and travel style.
            </p>

            <a href="{{ route('plan') }}" class="btn-gold-pill" style="padding: 0.85rem 1.85rem; font-size: 0.95rem;">
                <span>Start Planning</span>
                <span aria-hidden="true">&rarr;</span>
            </a>

            <!-- 3 Dynamic Stats from DB -->
            <div class="plan-stats-strip" aria-label="Platform Statistics">
                <!-- Destinations Count -->
                <div class="plan-stat-item">
                    <span class="plan-stat-number">
                        {{ $destinationsCount }}{{ $destinationsCount >= 10 ? '+' : '' }}
                    </span>
                    <span class="plan-stat-label">Destinations</span>
                </div>

                <!-- Places to Stay Count -->
                <div class="plan-stat-item">
                    <span class="plan-stat-number">
                        @if($placesToStayCount >= 100)
                            100+
                        @elseif($placesToStayCount >= 30)
                            {{ $placesToStayCount }}+
                        @else
                            {{ $placesToStayCount }}
                        @endif
                    </span>
                    <span class="plan-stat-label">Places to Stay</span>
                </div>

                <!-- Experiences Count -->
                <div class="plan-stat-item">
                    <span class="plan-stat-number">
                        @if($experiencesCount >= 100)
                            100+
                        @elseif($experiencesCount >= 50)
                            50+
                        @elseif($experiencesCount >= 20)
                            {{ $experiencesCount }}+
                        @else
                            {{ $experiencesCount }}
                        @endif
                    </span>
                    <span class="plan-stat-label">Experiences</span>
                </div>
            </div>
        </div>
    </div>
</section>
