@extends('layouts.app')
@section('title', "{$destination->name} - Complete Trip Guide & Itinerary Planner")

@section('content')
<div class="trip-detail-container">

    <!-- 1. HERO SECTION -->
    <div class="detail-hero-card">
        <div class="detail-hero-media">
            @if(!empty($destination->image_path))
                <img src="{{ asset($destination->image_path) }}" alt="{{ $destination->name }}" class="detail-hero-img">
            @else
                <x-scene-svg :destination="$destination" height="340px" />
            @endif
        </div>
        <div class="detail-hero-content">
            <div class="detail-hero-top">
                <span class="region-pill">{{ $destination->region }} Uganda</span>
                <span class="difficulty-pill">Difficulty: {{ $destination->difficulty }}</span>
                <span class="best-time-pill">Best Season: {{ $destination->best_time }}</span>
            </div>

            <h1 class="detail-title">{{ $destination->name }}</h1>
            <p class="detail-meta-lead">
                {{ $destination->min_days }} to {{ $destination->max_days }} days duration • Recommended: {{ $destination->rec_days }} days
            </p>

            <!-- Match Score Ring or Quiz Invitation -->
            <div class="match-score-container">
                @if($quiz)
                    <div class="match-ring">
                        <svg viewBox="0 0 36 36" class="circular-chart">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle" stroke-dasharray="{{ $matchScore }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <text x="18" y="20.35" class="percentage">{{ $matchScore }}%</text>
                        </svg>
                    </div>
                    <div class="match-text">
                        <strong>{{ $matchScore }}% Compatibility Match</strong>
                        <span>Calculated for {{ $quiz['days'] }}, {{ $quiz['style'] }} style from {{ $quiz['origin'] }}.</span>
                    </div>
                @else
                    <div class="quiz-prompt-box">
                        <span class="spark-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                            </svg>
                        </span>
                        <div>
                            <strong>Curious about your personalized match score?</strong>
                            <p>Take our 7-step travel quiz to calculate exact compatibility and live budget fit.</p>
                        </div>
                        <a href="{{ route('plan') }}" class="btn btn-sm btn-gold">Take the Quiz</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 2. DESCRIPTION & BUDGET FIT BANNER / CHEAPER ALTERNATIVE -->
    <div class="detail-section">
        <p class="destination-lead-desc">{{ $destination->description }}</p>

        @if($quiz)
            @php $diff = $budgetUgx - $costData['total']; @endphp
            @if($diff >= 0)
                <div class="budget-fit-banner within-budget">
                    <span class="fit-icon">✓</span>
                    <div>
                        <strong>You are within your budget!</strong>
                        <span>Estimated trip cost (@price($costData['total'])) leaves approx. <strong>@price($diff)</strong> remaining for discretionary spending.</span>
                    </div>
                </div>
            @else
                <div class="budget-fit-banner over-budget">
                    <span class="fit-icon">!</span>
                    <div>
                        <strong>This trip may exceed your budget by approx. @price(abs($diff)).</strong>
                        <span>Consider adjusting duration, choosing budget lodging, or reviewing our cheaper recommendation below.</span>
                    </div>
                </div>
            @endif

            @if($cheaperAlternative && $diff < 0)
                <div class="cheaper-alt-card">
                    <div class="cheaper-badge">Budget-Friendly Alternative</div>
                    <h4>Looking to stay strictly within budget?</h4>
                    <p>
                        <strong>{{ $cheaperAlternative['destination']->name }}</strong> offers comparable adventures within your 
                        @price($budgetUgx) budget at only <strong>@price($cheaperAlternative['cost']['total'])</strong>!
                    </p>
                    <a href="{{ route('destinations.show', $cheaperAlternative['destination']->slug) }}" class="btn btn-sm btn-primary">
                        View {{ $cheaperAlternative['destination']->name }} →
                    </a>
                </div>
            @endif
        @endif
    </div>

    <!-- 3. JUMP BUTTONS (Smooth Scroll) -->
    <div class="jump-nav-bar">
        <span>Jump to:</span>
        <a href="#stay-and-eat" class="jump-link">Stay & Eat</a>
        <a href="#match-breakdown" class="jump-link">Match & Costs</a>
        <a href="#itinerary" class="jump-link">Itinerary</a>
        <a href="#budget-builder" class="jump-link">Budget Builder</a>
    </div>

    <!-- 4. THREE CARDS NEAR TOP: STAY, EAT, RECREATION NEAR X -->
    <div class="quick-picks-section" id="stay-and-eat">
        <div class="quick-picks-grid">
            <!-- Where to Stay Near X -->
            <div class="quick-pick-card">
                <div class="pick-card-header">
                    <h3>Where to stay near {{ $destination->name }}</h3>
                    <a href="{{ route('stays', ['destination' => $destination->id]) }}" class="see-all-link">See all →</a>
                </div>
                <div class="pick-items-list">
                    @forelse($stays as $stay)
                        <div class="pick-item" data-id="{{ $stay->id }}" data-category="stay" data-name="{{ $stay->name }}" data-price="{{ $stay->price_ugx }}">
                            <div class="pick-item-info">
                                <span class="pick-item-name">{{ $stay->name }}</span>
                                <span class="pick-item-type">{{ $stay->type ?? 'Lodge' }}</span>
                                <span class="pick-item-price">@price($stay->price_ugx) / night</span>
                            </div>
                            <div class="pick-item-actions">
                                <span class="fits-plan-badge">Fits your plan</span>
                                <button type="button" class="btn-choose" onclick="selectQuickPick('stay', '{{ $stay->name }}', {{ $stay->price_ugx }}, this)">
                                    Choose
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Lodging options will be listed shortly.</p>
                    @endforelse
                </div>
            </div>

            <!-- Where to Eat Near X -->
            <div class="quick-pick-card">
                <div class="pick-card-header">
                    <h3>Where to eat near {{ $destination->name }}</h3>
                    <a href="{{ route('eat', ['destination' => $destination->id]) }}" class="see-all-link">See all →</a>
                </div>
                <div class="pick-items-list">
                    @forelse($eatPlaces as $eat)
                        <div class="pick-item" data-id="{{ $eat->id }}" data-category="eat" data-name="{{ $eat->name }}" data-price="{{ $eat->price_ugx }}">
                            <div class="pick-item-info">
                                <span class="pick-item-name">{{ $eat->name }}</span>
                                <span class="pick-item-type">{{ $eat->type ?? 'Restaurant' }}</span>
                                <span class="pick-item-price">@price($eat->price_ugx) / meal</span>
                            </div>
                            <div class="pick-item-actions">
                                <span class="fits-plan-badge">Fits your plan</span>
                                <button type="button" class="btn-choose" onclick="selectQuickPick('eat', '{{ $eat->name }}', {{ $eat->price_ugx }}, this)">
                                    Choose
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Local dining spots will be listed shortly.</p>
                    @endforelse
                </div>
            </div>

            <!-- Recreation & Activities Near X -->
            <div class="quick-pick-card">
                <div class="pick-card-header">
                    <h3>Recreation near {{ $destination->name }}</h3>
                    <a href="{{ route('recreation', ['destination' => $destination->id]) }}" class="see-all-link">See all →</a>
                </div>
                <div class="pick-items-list">
                    @forelse($recreationPlaces as $rec)
                        <div class="pick-item" data-id="{{ $rec->id }}" data-category="recreation" data-name="{{ $rec->name }}" data-price="{{ $rec->price_ugx }}">
                            <div class="pick-item-info">
                                <span class="pick-item-name">{{ $rec->name }}</span>
                                <span class="pick-item-type">{{ $rec->type ?? 'Activity' }}</span>
                                <span class="pick-item-price">@price($rec->price_ugx) / person</span>
                            </div>
                            <div class="pick-item-actions">
                                <span class="fits-plan-badge">Fits your plan</span>
                                <button type="button" class="btn-choose" onclick="selectQuickPick('rec', '{{ $rec->name }}', {{ $rec->price_ugx }}, this)">
                                    Choose
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Recreation activities will be listed shortly.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- 5. WHY IT MATCHES YOU (6 SCORE BARS) & COST BREAKDOWN TABLE -->
    <div class="match-breakdown-section" id="match-breakdown">
        <div class="breakdown-grid">
            <!-- 6 Score Bars -->
            <div class="score-bars-card">
                <h3>Compatibility Breakdown</h3>
                <p class="section-sub">Detailed assessment of how this trip fits your travel preferences:</p>

                <div class="bars-list">
                    <div class="score-bar-item">
                        <div class="bar-labels">
                            <span>Budget Affordability</span>
                            <strong>{{ $scores['budget'] }} / 25 pts</strong>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($scores['budget'] / 25) * 100 }}%;"></div></div>
                    </div>

                    <div class="score-bar-item">
                        <div class="bar-labels">
                            <span>Interests & Activities</span>
                            <strong>{{ $scores['interests'] }} / 25 pts</strong>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($scores['interests'] / 25) * 100 }}%;"></div></div>
                    </div>

                    <div class="score-bar-item">
                        <div class="bar-labels">
                            <span>Time & Pace Suitability</span>
                            <strong>{{ $scores['time'] }} / 20 pts</strong>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($scores['time'] / 20) * 100 }}%;"></div></div>
                    </div>

                    <div class="score-bar-item">
                        <div class="bar-labels">
                            <span>Distance & Travel Time</span>
                            <strong>{{ $scores['distance'] }} / 10 pts</strong>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($scores['distance'] / 10) * 100 }}%;"></div></div>
                    </div>

                    <div class="score-bar-item">
                        <div class="bar-labels">
                            <span>Travel Group Fit</span>
                            <strong>{{ $scores['group'] }} / 10 pts</strong>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($scores['group'] / 10) * 100 }}%;"></div></div>
                    </div>

                    <div class="score-bar-item">
                        <div class="bar-labels">
                            <span>Lodging & Comfort Style</span>
                            <strong>{{ $scores['style'] }} / 10 pts</strong>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ ($scores['style'] / 10) * 100 }}%;"></div></div>
                    </div>
                </div>
            </div>

            <!-- Cost Breakdown Table -->
            <div class="cost-table-card">
                <h3>Estimated Cost Breakdown</h3>
                <p class="section-sub">Calculated for <strong>{{ $days }} days</strong> ({{ $costData['nights'] }} nights) in <strong>{{ $style }}</strong> style from {{ $origin }}:</p>
                
                <table class="cost-table">
                    <tbody>
                        <tr>
                            <td>Transport (Road + Local)</td>
                            <td class="text-right">@price($costData['transport'])</td>
                        </tr>
                        <tr>
                            <td>Accommodation ({{ $costData['nights'] }} nights)</td>
                            <td class="text-right">@price($costData['accommodation'])</td>
                        </tr>
                        <tr>
                            <td>Food & Dining ({{ $days }} days)</td>
                            <td class="text-right">@price($costData['food'])</td>
                        </tr>
                        <tr>
                            <td>Activities & Park Access</td>
                            <td class="text-right">@price($costData['activities'])</td>
                        </tr>
                        <tr>
                            <td>Emergency & Contingency (10%)</td>
                            <td class="text-right">@price($costData['misc'])</td>
                        </tr>
                        <tr class="cost-table-total">
                            <td><strong>Estimated Total (Per Person)</strong></td>
                            <td class="text-right"><strong>@price($costData['total'])</strong></td>
                        </tr>
                    </tbody>
                </table>
                <p class="table-disclaimer">
                    * Prices are transparent estimates based on seasonal averages and current fuel/entry tariffs.
                </p>
            </div>
        </div>
    </div>

    <!-- 6. SUGGESTED ITINERARY & DESTINATION INSIGHTS -->
    <div class="detail-section" id="itinerary">
        <h2 class="section-heading">Suggested {{ $days }}-Day Itinerary</h2>
        <div class="itinerary-timeline">
            @php
                $acts = $destination->activities ?? ['Sightseeing', 'Nature walk', 'Cultural tour'];
                $actCount = count($acts);
            @endphp

            @for($d = 1; $d <= $days; $d++)
                <div class="timeline-day-card">
                    <div class="day-number-badge">Day {{ $d }}</div>
                    <div class="day-content">
                        @if($d === 1)
                            <h4>Arrival & Scenic Welcome</h4>
                            <p>Depart from {{ $origin }} toward {{ $destination->name }} (approx. {{ $costData['dist_km'] }} km, {{ $costData['hours'] }} hrs). Check into your accommodation, unwind, and enjoy your first evening sunset meal.</p>
                        @elseif($d === $days)
                            <h4>Farewell & Return Journey</h4>
                            <p>Morning leisure and photography. Conclude with souvenir craft shopping before your return journey back to {{ $origin }}.</p>
                        @else
                            @php $actIndex = ($d - 2) % max(1, $actCount); @endphp
                            <h4>{{ $acts[$actIndex] ?? 'Adventure Exploration' }}</h4>
                            <p>Immerse yourself in authentic experiences around {{ $destination->name }}. Follow local ranger guidance for optimal wildlife and scenery encounters.</p>
                        @endif
                    </div>
                </div>
            @endfor
        </div>

        <!-- Accommodation by Style -->
        <div class="dest-info-boxes-grid">
            <div class="info-card">
                <h4>Lodging Options by Style</h4>
                <ul class="styled-list">
                    <li><strong>Budget:</strong> {{ $destination->hotel_names['Budget'] ?? 'Backpackers / Camp' }} (@price($destination->accommodation_costs['Budget'] ?? 40000) / night)</li>
                    <li><strong>Moderate:</strong> {{ $destination->hotel_names['Moderate'] ?? 'Safari Eco-Lodge' }} (@price($destination->accommodation_costs['Moderate'] ?? 150000) / night)</li>
                    <li><strong>Luxury:</strong> {{ $destination->hotel_names['Luxury'] ?? 'Luxury Resort' }} (@price($destination->accommodation_costs['Luxury'] ?? 450000) / night)</li>
                </ul>
            </div>

            <div class="info-card">
                <h4>Transport Information</h4>
                <p>Located approx. <strong>{{ $costData['dist_km'] }} km</strong> from {{ $origin }}. Average driving time is approx. <strong>{{ $costData['hours'] }} hours</strong>. Accessible via public shared taxis, private car hire, and organized tour vans.</p>
            </div>

            <div class="info-card">
                <h4>Tips & Safety</h4>
                <p><strong>Tips:</strong> {{ $destination->tips }}</p>
                <p style="margin-top: 0.5rem;"><strong>Safety:</strong> {{ $destination->safety }}</p>
            </div>
        </div>
    </div>

    <!-- 7. BUILD YOUR TRIP BUDGET (Interactive Live Calculator) -->
    <div class="budget-builder-card" id="budget-builder">
        <div class="builder-header">
            <h2>Build Your Trip Budget</h2>
            <p>Customize your people count, vehicle option, and pick your favorite places to stay, eat, and visit for a real-time price total.</p>
        </div>

        <div class="builder-controls-row">
            <!-- People Selector -->
            <div class="builder-field">
                <label for="builderPeople">Travelers (People):</label>
                <select id="builderPeople" onchange="calculateLiveBudget()">
                    <option value="1">1 Person (Solo)</option>
                    <option value="2" selected>2 People (Couple / Pair)</option>
                    <option value="3">3 People</option>
                    <option value="4">4 People</option>
                    <option value="5">5 People</option>
                    <option value="6">6 People (Group)</option>
                </select>
            </div>

            <!-- Transport Options -->
            <div class="builder-field">
                <label for="builderTransport">Transport Mode:</label>
                <select id="builderTransport" onchange="calculateLiveBudget()">
                    <option value="shared">Shared Taxi / Bus (Public)</option>
                    <option value="private" selected>Private Car + Driver (Full Vehicle)</option>
                    <option value="selfdrive">Self-Drive Fuel (Your Vehicle)</option>
                </select>
            </div>
        </div>

        <!-- Tick-Lists for Stays, Eat, Visit, Recreation -->
        <div class="ticklists-grid">
            <!-- Stays -->
            <div class="tick-group">
                <h4>Where to Stay ({{ $costData['nights'] }} Nights)</h4>
                @foreach($stays as $s)
                    <label class="tick-label">
                        <input type="radio" name="builder_stay" value="{{ $s->price_ugx }}" onchange="calculateLiveBudget()" {{ $loop->first ? 'checked' : '' }}>
                        @if(!empty($s->image_path))
                            <img src="{{ asset($s->image_path) }}" alt="{{ $s->name }}" class="tick-thumb" loading="lazy">
                        @endif
                        <span class="tick-name">{{ $s->name }}</span>
                        <strong>@price($s->price_ugx) / night</strong>
                    </label>
                @endforeach
            </div>

            <!-- Meals -->
            <div class="tick-group">
                <h4>Where to Eat (Daily Spend)</h4>
                @foreach($eatPlaces as $e)
                    <label class="tick-label">
                        <input type="radio" name="builder_eat" value="{{ $e->price_ugx }}" onchange="calculateLiveBudget()" {{ $loop->first ? 'checked' : '' }}>
                        @if(!empty($e->image_path))
                            <img src="{{ asset($e->image_path) }}" alt="{{ $e->name }}" class="tick-thumb" loading="lazy">
                        @endif
                        <span class="tick-name">{{ $e->name }}</span>
                        <strong>@price($e->price_ugx) / meal</strong>
                    </label>
                @endforeach
            </div>

            <!-- Places to Visit -->
            <div class="tick-group">
                <h4>Places to Visit (Entry Fee)</h4>
                @foreach($visitPlaces as $v)
                    <label class="tick-label">
                        <input type="checkbox" class="visit-check" value="{{ $v->price_ugx }}" onchange="calculateLiveBudget()" checked>
                        <span>{{ $v->name }}</span>
                        <strong>@price($v->price_ugx)</strong>
                    </label>
                @endforeach
                @foreach($vendorVisits as $vv)
                    <label class="tick-label community-tick">
                        <input type="checkbox" class="visit-check" value="{{ $vv->price_ugx }}" onchange="calculateLiveBudget()">
                        <span>{{ $vv->name }} (Community)</span>
                        <strong>@price($vv->price_ugx)</strong>
                    </label>
                @endforeach
            </div>

            <!-- Recreation & Activities -->
            <div class="tick-group">
                <h4>Recreation & Activities (Session Fee)</h4>
                @foreach($recreationPlaces as $r)
                    <label class="tick-label">
                        <input type="checkbox" class="rec-check" value="{{ $r->price_ugx }}" onchange="calculateLiveBudget()" checked>
                        <span>{{ $r->name }}</span>
                        <strong>@price($r->price_ugx)</strong>
                    </label>
                @endforeach
                @foreach($vendorRecs as $vr)
                    <label class="tick-label community-tick">
                        <input type="checkbox" class="rec-check" value="{{ $vr->price_ugx }}" onchange="calculateLiveBudget()">
                        <span>{{ $vr->name }} Entry</span>
                        <strong>@price($vr->price_ugx)</strong>
                    </label>
                    @foreach($vr->activities as $vAct)
                        <label class="tick-label sub-activity-tick">
                            <input type="checkbox" class="rec-check" value="{{ $vAct->fee_ugx }}" onchange="calculateLiveBudget()">
                            <span>↳ {{ $vAct->name }}</span>
                            <strong>@price($vAct->fee_ugx)</strong>
                        </label>
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Live Budget Output Bar -->
        <div class="builder-output-bar">
            <div class="live-total-box">
                <span class="total-caption">Live Custom Trip Total:</span>
                <span class="total-figure" id="liveTotalDisplay">Calculating...</span>
                <span class="total-subtitle">Covers transport, lodging, food & selected activities for all travelers</span>
            </div>
            <div class="live-budget-status" id="liveBudgetStatus">
                <!-- Injected via JavaScript -->
            </div>
        </div>
    </div>

    <!-- 8. ACTION BUTTONS: SAVE, SHARE, PLAN ANOTHER TRIP -->
    <div class="detail-actions-bar">
        <!-- Save Trip Form -->
        <form action="{{ route('saved.store') }}" method="POST">
            @csrf
            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
            <input type="hidden" name="days" value="{{ $days }}">
            <input type="hidden" name="style" value="{{ $style }}">
            <input type="hidden" name="total_ugx" id="saveTripTotal" value="{{ $costData['total'] }}">
            <button type="submit" class="btn btn-gold">
                Save Trip Plan
            </button>
        </form>

        <!-- Web Share API Button with Copy Link Fallback -->
        <button type="button" class="btn btn-outline" id="shareTripBtn" onclick="shareTripPlan()">
            Share Trip
        </button>

        <a href="{{ route('plan') }}" class="btn btn-outline">
            Plan Another Trip
        </a>
    </div>

</div>

<!-- Interactive Budget Calculation Script -->
<script>
    const distKm = {{ $costData['dist_km'] }};
    const days = {{ $days }};
    const nights = {{ $costData['nights'] }};
    const localTransportCost = {{ $destination->local_transport_cost }};
    const targetBudgetUgxPerPerson = {{ $budgetUgx }};

    function calculateLiveBudget() {
        const people = parseInt(document.getElementById('builderPeople').value) || 1;
        const transportMode = document.getElementById('builderTransport').value;

        // Transport formula
        let transportCost = 0;
        if (transportMode === 'shared') {
            // max(15000, km x 700) per person
            transportCost = Math.max(15000, distKm * 700) * people;
        } else if (transportMode === 'private') {
            // max(80000, km x 2 x 1800) per vehicle
            transportCost = Math.max(80000, distKm * 2 * 1800);
        } else {
            // self-drive fuel: km x 2 x 500
            transportCost = distKm * 2 * 500;
        }

        // Local transport
        const localTransport = localTransportCost * days;

        // Lodging: stay price x nights x ceil(people/2)
        const selectedStayRadio = document.querySelector('input[name="builder_stay"]:checked');
        const stayPrice = selectedStayRadio ? parseInt(selectedStayRadio.value) : 0;
        const lodgingRooms = Math.ceil(people / 2);
        const stayTotal = stayPrice * nights * lodgingRooms;

        // Meals: meal price x days x people
        const selectedEatRadio = document.querySelector('input[name="builder_eat"]:checked');
        const mealPrice = selectedEatRadio ? parseInt(selectedEatRadio.value) : 0;
        const eatTotal = mealPrice * days * people;

        // Visits: entry price x people
        let visitTotal = 0;
        document.querySelectorAll('.visit-check:checked').forEach(cb => {
            visitTotal += parseInt(cb.value) * people;
        });

        // Recreation: entry price x people
        let recTotal = 0;
        document.querySelectorAll('.rec-check:checked').forEach(cb => {
            recTotal += parseInt(cb.value) * people;
        });

        const liveTotalUgx = transportCost + localTransport + stayTotal + eatTotal + visitTotal + recTotal;
        const targetBudgetGroup = targetBudgetUgxPerPerson * people;
        const diff = targetBudgetGroup - liveTotalUgx;

        // Update hidden save form input
        document.getElementById('saveTripTotal').value = Math.round(liveTotalUgx);

        // Render formatted live total
        document.getElementById('liveTotalDisplay').textContent = 'UGX ' + liveTotalUgx.toLocaleString();

        // Render budget status
        const statusEl = document.getElementById('liveBudgetStatus');
        if (diff >= 0) {
            statusEl.innerHTML = `<span class="badge-within">✓ Within Budget</span><p>approx. UGX ${diff.toLocaleString()} remaining for ${people} travelers.</p>`;
        } else {
            statusEl.innerHTML = `<span class="badge-over">! Exceeds Target</span><p>approx. UGX ${Math.abs(diff).toLocaleString()} over group target budget.</p>`;
        }
    }

    function selectQuickPick(category, name, price, btn) {
        // Find corresponding radio in the budget builder
        if (category === 'stay') {
            const radios = document.querySelectorAll('input[name="builder_stay"]');
            radios.forEach(r => {
                if (parseInt(r.value) === price) r.checked = true;
            });
        } else if (category === 'eat') {
            const radios = document.querySelectorAll('input[name="builder_eat"]');
            radios.forEach(r => {
                if (parseInt(r.value) === price) r.checked = true;
            });
        }
        calculateLiveBudget();

        // Visual feedback
        const allBtns = btn.closest('.quick-pick-card').querySelectorAll('.btn-choose');
        allBtns.forEach(b => {
            b.textContent = 'Choose';
            b.classList.remove('btn-chosen');
        });
        btn.textContent = '✓ Chosen';
        btn.classList.add('btn-chosen');
    }

    function shareTripPlan() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $destination->name }} - Pearl Trails Uganda Itinerary',
                text: 'Check out this custom trip to {{ $destination->name }} with estimated costs and itinerary on Pearl Trails!',
                url: window.location.href,
            }).catch(() => {});
        } else {
            navigator.clipboard.writeText(window.location.href);
            const btn = document.getElementById('shareTripBtn');
            const originalText = btn.textContent;
            btn.textContent = '✓ Link Copied!';
            setTimeout(() => { btn.textContent = originalText; }, 2500);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        calculateLiveBudget();
    });
</script>
@endsection
