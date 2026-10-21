@extends('layouts.app')
@section('title', 'Plan My Trip - 7-Step Uganda Travel Wizard')

@section('content')
<div class="quiz-container">
    <div class="quiz-header">
        <span class="quiz-badge">Custom Trip Matcher</span>
        <h1 class="quiz-title">Find Your Perfect Uganda Adventure</h1>
        <p class="quiz-subtitle">Answer 7 quick questions to receive personalized destination recommendations with transparent budget breakdowns.</p>
        
        <!-- Progress Bar -->
        <div class="quiz-progress-bar-wrapper">
            <div class="quiz-progress-info">
                <span>Step <strong id="currentStepLabel">1</strong> of 7</span>
                <span id="stepTitleLabel">Starting Location</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" id="progressFill" style="width: 14.28%;"></div>
            </div>
        </div>
    </div>

    <form action="{{ route('plan.submit') }}" method="POST" id="tripQuizForm" class="quiz-card">
        @csrf

        <!-- STEP 1: Starting Location -->
        <div class="quiz-step active" data-step="1" data-title="Starting Location">
            <h2 class="step-question">Where are you starting your journey from?</h2>
            <p class="step-help">We calculate accurate road distance and travel times from your origin in Uganda.</p>
            <div class="options-grid">
                @foreach($origins as $orig)
                    <label class="choice-tile">
                        <input type="radio" name="origin" value="{{ $orig }}" {{ ($savedQuiz['origin'] ?? 'Kampala') === $orig ? 'checked' : '' }} required>
                        <div class="tile-content">
                            <span class="tile-icon">📍</span>
                            <span class="tile-name">{{ $orig }}</span>
                            <span class="tile-desc">{{ $orig === 'Other' ? 'Uganda Border / Regional Hub' : 'Uganda Origin' }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 2: Budget Band -->
        <div class="quiz-step" data-step="2" data-title="Your Target Budget">
            <h2 class="step-question">What is your target budget per person?</h2>
            <p class="step-help">Showing budget bands in <strong>{{ $currentCurrency }}</strong>. All calculations include transport, stays, food, activities & contingency.</p>
            <div class="options-grid">
                @foreach($budgetBands as $band)
                    <label class="choice-tile">
                        <input type="radio" name="budget_band" value="{{ $band['id'] }}" {{ ($savedQuiz['budget_band'] ?? '') === $band['id'] ? 'checked' : '' }} required>
                        <div class="tile-content">
                            <span class="tile-icon">💵</span>
                            <span class="tile-name">{{ $band['label'] }}</span>
                            <span class="tile-desc">Per person estimate</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 3: Available Time -->
        <div class="quiz-step" data-step="3" data-title="Available Duration">
            <h2 class="step-question">How much time do you have for this trip?</h2>
            <p class="step-help">Choose the duration that best fits your travel schedule.</p>
            <div class="options-grid">
                @foreach($timeOptions as $time)
                    <label class="choice-tile">
                        <input type="radio" name="days" value="{{ $time }}" {{ ($savedQuiz['days'] ?? '3 days') === $time ? 'checked' : '' }} required>
                        <div class="tile-content">
                            <span class="tile-icon">⏱️</span>
                            <span class="tile-name">{{ $time }}</span>
                            <span class="tile-desc">
                                @if($time === '1 day') Day Excursion
                                @elseif($time === 'Weekend') 2 Days / 1 Night
                                @elseif($time === '3 days') 3 Days / 2 Nights
                                @elseif($time === '5 days') 5 Days / 4 Nights
                                @else 7+ Days Expedition
                                @endif
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 4: Travel Group -->
        <div class="quiz-step" data-step="4" data-title="Travel Companions">
            <h2 class="step-question">Who are you traveling with?</h2>
            <p class="step-help">We match destinations with amenities suited for your travel group.</p>
            <div class="options-grid">
                @foreach($groups as $grp)
                    <label class="choice-tile">
                        <input type="radio" name="group" value="{{ $grp }}" {{ ($savedQuiz['group'] ?? 'Friends') === $grp ? 'checked' : '' }} required>
                        <div class="tile-content">
                            <span class="tile-icon">
                                @if($grp === 'Solo') 🎒
                                @elseif($grp === 'Couple') 💑
                                @elseif($grp === 'Family') 👨‍👩‍👧‍👦
                                @elseif($grp === 'Friends') 👥
                                @else 🚌
                                @endif
                            </span>
                            <span class="tile-name">{{ $grp }}</span>
                            <span class="tile-desc">{{ $grp }} friendly experiences</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 5: Interests (Multi-select) -->
        <div class="quiz-step" data-step="5" data-title="Your Interests">
            <h2 class="step-question">What experiences excite you most?</h2>
            <p class="step-help">Select one or more interests. We prioritize destinations with matching activities.</p>
            <div class="options-grid">
                @foreach($interests as $interest)
                    <label class="choice-tile checkbox-tile">
                        <input type="checkbox" name="interests[]" value="{{ $interest }}" {{ in_array($interest, (array) ($savedQuiz['interests'] ?? ['Adventure', 'Nature'])) ? 'checked' : '' }}>
                        <div class="tile-content">
                            <span class="tile-icon">
                                @if($interest === 'Wildlife') 🦁
                                @elseif($interest === 'Adventure') 🛶
                                @elseif($interest === 'Nature') 🌿
                                @elseif($interest === 'Beaches/Lakes') 🏖️
                                @elseif($interest === 'Hiking') 🥾
                                @elseif($interest === 'Culture') 🥁
                                @elseif($interest === 'History') 🏛️
                                @elseif($interest === 'Food') 🍲
                                @elseif($interest === 'Photography') 📸
                                @elseif($interest === 'Relaxation') 🧘
                                @else 🌙
                                @endif
                            </span>
                            <span class="tile-name">{{ $interest }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 6: Travel Style -->
        <div class="quiz-step" data-step="6" data-title="Travel Comfort Style">
            <h2 class="step-question">What is your preferred travel style?</h2>
            <p class="step-help">Determines accommodation tiers, transport options, and meal standards.</p>
            <div class="options-grid">
                @foreach($styles as $st)
                    <label class="choice-tile">
                        <input type="radio" name="style" value="{{ $st }}" {{ ($savedQuiz['style'] ?? 'Moderate') === $st ? 'checked' : '' }} required>
                        <div class="tile-content">
                            <span class="tile-icon">
                                @if($st === 'Budget') ⛺
                                @elseif($st === 'Moderate') 🏡
                                @else 🏨
                                @endif
                            </span>
                            <span class="tile-name">{{ $st }}</span>
                            <span class="tile-desc">
                                @if($st === 'Budget') Hostels, shared transport & local authentic diners
                                @elseif($st === 'Moderate') Comfortable eco-lodges, private safari transport & quality meals
                                @else Luxury safari lodges, premium private driver & fine dining
                                @endif
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- STEP 7: Trip Preference -->
        <div class="quiz-step" data-step="7" data-title="Trip Atmosphere">
            <h2 class="step-question">What vibe or atmosphere do you desire?</h2>
            <p class="step-help">Select the primary mood you want for your Uganda journey.</p>
            <div class="options-grid">
                @foreach($preferences as $pref)
                    <label class="choice-tile">
                        <input type="radio" name="preference" value="{{ $pref }}" {{ ($savedQuiz['preference'] ?? 'Adventurous') === $pref ? 'checked' : '' }} required>
                        <div class="tile-content">
                            <span class="tile-icon">
                                @if($pref === 'Relaxing') 🌅
                                @elseif($pref === 'Adventurous') ⚡
                                @elseif($pref === 'Educational') 📜
                                @elseif($pref === 'Romantic') 💖
                                @elseif($pref === 'Family-friendly') 🎈
                                @else 🥳
                                @endif
                            </span>
                            <span class="tile-name">{{ $pref }}</span>
                            <span class="tile-desc">{{ $pref }} focus</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Form Navigation Footer -->
        <div class="quiz-nav-footer">
            <button type="button" class="btn btn-outline" id="prevBtn" style="display: none;">
                ← Back
            </button>
            <div class="quiz-nav-spacer"></div>
            <button type="button" class="btn btn-primary" id="nextBtn" disabled>
                Next Step →
            </button>
            <button type="submit" class="btn btn-gold" id="submitBtn" style="display: none;" disabled>
                ✨ Show My Top Destinations
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 1;
    const totalSteps = 7;

    const steps = document.querySelectorAll('.quiz-step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const progressFill = document.getElementById('progressFill');
    const currentStepLabel = document.getElementById('currentStepLabel');
    const stepTitleLabel = document.getElementById('stepTitleLabel');

    function checkStepValidity(stepNum) {
        const activeStepEl = document.querySelector(`.quiz-step[data-step="${stepNum}"]`);
        if (!activeStepEl) return false;

        if (stepNum === 5) {
            // Checkbox step (interests)
            const checkedBoxes = activeStepEl.querySelectorAll('input[type="checkbox"]:checked');
            return checkedBoxes.length > 0;
        } else {
            // Radio step
            const checkedRadio = activeStepEl.querySelector('input[type="radio"]:checked');
            return checkedRadio !== null;
        }
    }

    function updateNavState() {
        const isValid = checkStepValidity(currentStep);

        if (currentStep === 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'inline-flex';
        }

        if (currentStep === totalSteps) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-flex';
            submitBtn.disabled = !isValid;
        } else {
            nextBtn.style.display = 'inline-flex';
            submitBtn.style.display = 'none';
            nextBtn.disabled = !isValid;
        }

        // Progress indicators
        const percent = (currentStep / totalSteps) * 100;
        progressFill.style.width = percent + '%';
        currentStepLabel.textContent = currentStep;

        const activeStepEl = document.querySelector(`.quiz-step[data-step="${currentStep}"]`);
        if (activeStepEl) {
            stepTitleLabel.textContent = activeStepEl.getAttribute('data-title') || '';
        }
    }

    function showStep(stepNum) {
        steps.forEach(step => {
            if (parseInt(step.getAttribute('data-step')) === stepNum) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
        currentStep = stepNum;
        updateNavState();
        window.scrollTo({ top: document.querySelector('.quiz-container').offsetTop - 80, behavior: 'smooth' });
    }

    // Next button click
    nextBtn.addEventListener('click', function () {
        if (checkStepValidity(currentStep) && currentStep < totalSteps) {
            showStep(currentStep + 1);
        }
    });

    // Prev button click
    prevBtn.addEventListener('click', function () {
        if (currentStep > 1) {
            showStep(currentStep - 1);
        }
    });

    // Form inputs change listener to validate and enable buttons
    document.getElementById('tripQuizForm').addEventListener('change', function () {
        updateNavState();
    });

    // Initial check
    updateNavState();
});
</script>
@endsection
