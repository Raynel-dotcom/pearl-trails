@extends('layouts.app')
@section('title', 'List Your Business - Partner with Pearl Trails Uganda')
@section('meta_description', 'Register your Ugandan lodge, restaurant, tour company, or recreation centre on Pearl Trails to reach domestic and international travelers.')

@section('content')
<div class="vendor-form-container">
    <div class="page-hero">
        <span class="quiz-badge">Tourism Partner Network</span>
        <h1>List Your Uganda Tourism Business</h1>
        <p>Promote your hotel, safari lodge, hostel, restaurant, tourist site, or recreation centre to travelers exploring the Pearl of Africa.</p>
    </div>

    @if(session('success'))
        <div class="alert-success-banner" role="alert" style="margin-bottom: 2rem;">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error-banner" role="alert" style="margin-bottom: 2rem;">
            <strong>Please resolve the following errors:</strong>
            <ul style="margin: 0.5rem 0 0 1.25rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @guest
        <!-- Guest Partner Onboarding Banner -->
        <div class="auth-notice-card" style="background: var(--forest, #12301f); border: 1px solid rgba(232, 163, 23, 0.35); border-radius: 20px; padding: 2.5rem 2rem; text-align: center; margin-bottom: 2.5rem; box-shadow: 0 16px 36px rgba(0,0,0,0.35);">
            <span class="quiz-badge" style="margin-bottom: 0.75rem; display: inline-block;">Get Started in 60 Seconds</span>
            <h2 style="font-family: var(--font-serif, Georgia, serif); color: var(--white, #fff); font-size: 1.85rem; margin-bottom: 0.75rem;">Join the Pearl Trails Partner Network</h2>
            <p style="color: rgba(247, 241, 227, 0.85); max-width: 640px; margin: 0 auto 1.75rem; font-size: 1rem; line-height: 1.6;">
                Showcase your property to thousands of international safari explorers and domestic travelers. Sign up or log in to submit your pricing, photos, and direct booking links.
            </p>
            <div class="auth-notice-btns" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('register', ['role' => 'vendor', 'redirect_to' => '/list-your-business']) }}" class="btn-gold-pill" style="padding: 0.85rem 2rem; font-size: 1rem;">
                    <span>Create Vendor Account & List Business</span>
                    <span aria-hidden="true">&rarr;</span>
                </a>
                <a href="{{ route('login', ['redirect_to' => '/list-your-business']) }}" class="btn-vendor-outline" style="padding: 0.85rem 1.75rem; font-size: 0.95rem;">
                    Sign In to Existing Account
                </a>
            </div>

            <!-- Value Pillars -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-top: 2.5rem; text-align: left; border-top: 1px solid rgba(232, 163, 23, 0.2); padding-top: 2rem;">
                <div>
                    <h4 style="color: var(--gold, #e8a317); margin: 0 0 0.35rem; font-size: 1rem;">0% Commission</h4>
                    <p style="color: rgba(247, 241, 227, 0.75); font-size: 0.85rem; margin: 0; line-height: 1.5;">Direct bookings link straight to your website and WhatsApp without intermediary markups.</p>
                </div>
                <div>
                    <h4 style="color: var(--gold, #e8a317); margin: 0 0 0.35rem; font-size: 1rem;">All-Category Coverage</h4>
                    <p style="color: rgba(247, 241, 227, 0.75); font-size: 0.85rem; margin: 0; line-height: 1.5;">List stays, traditional eateries, recreation activities, guided tours, and tourist attractions.</p>
                </div>
                <div>
                    <h4 style="color: var(--gold, #e8a317); margin: 0 0 0.35rem; font-size: 1rem;">Verified Quality Badge</h4>
                    <p style="color: rgba(247, 241, 227, 0.75); font-size: 0.85rem; margin: 0; line-height: 1.5;">Approved listings earn a verified badge and featured placement in Uganda trip recommendations.</p>
                </div>
            </div>
        </div>
    @else
        <!-- Authenticated Listing Submission Form -->
        <form action="{{ route('list-business.store') }}" method="POST" enctype="multipart/form-data" class="vendor-listing-form">
            @csrf

            <!-- Section 1: Business Basics -->
            <div class="form-section-title">
                <h3>1. Business Basics</h3>
                <p>Categorize your tourism business across Stays, Eats, Recreation, or Attractions.</p>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label for="businessType">Business Category *</label>
                    <select name="type" id="businessType" required>
                        <option value="">Select Category...</option>
                        @foreach($listingTypes as $type)
                            <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="businessName">Business Name *</label>
                    <input type="text" name="name" id="businessName" value="{{ old('name') }}" placeholder="e.g. Nile Rapids Adventure Camp or Gorilla Mist Lodge" required>
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label for="destSelect">Destination Area</label>
                    <select name="destination_id" id="destSelect">
                        <option value="">Specific Destination or Select "Other"...</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ old('destination_id') == $dest->id ? 'selected' : '' }}>
                                {{ $dest->name }} ({{ $dest->region }} Uganda)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="customLocation">Other Area / Specific Town</label>
                    <input type="text" name="custom_location" id="customLocation" value="{{ old('custom_location') }}" placeholder="e.g. Ruhija, Buhoma, Jinja Nile bank, or Entebbe Road">
                </div>
            </div>

            <!-- Section 2: Pricing & Photos -->
            <div class="form-section-title">
                <h3>2. Pricing & Property Photos</h3>
                <p>Provide transparent standard rates in Ugandan Shillings (UGX) and an authentic picture.</p>
            </div>

            <div class="form-group">
                <label for="priceUgx">Standard Rate / Price (in UGX) *</label>
                <input type="number" name="price_ugx" id="priceUgx" value="{{ old('price_ugx') }}" placeholder="e.g. 150000" required min="0">
                <span class="field-hint">For stays: price per night. For restaurants: average meal cost. For recreation/activities: standard entrance or session fee.</span>
            </div>

            <div class="form-group">
                <label for="businessPhoto">Property Photo / Cover Picture (WebP, JPG, PNG - Max 8MB)</label>
                <input type="file" name="image" id="businessPhoto" accept="image/webp,image/jpeg,image/png,image/jpg" onchange="previewListingPhoto(this)">
                <span class="field-hint">Upload a high-resolution photo showcasing your lodge, dining area, recreation equipment, or scenic grounds.</span>
                
                <div id="photoPreviewContainer" style="display: none; margin-top: 1rem; max-width: 380px; border-radius: 14px; overflow: hidden; border: 1px solid var(--gold); box-shadow: 0 8px 24px rgba(0,0,0,0.3);">
                    <img id="photoPreviewImg" src="#" alt="Photo preview" style="width: 100%; height: auto; display: block;">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Business Overview & Highlights</label>
                <textarea name="description" id="description" rows="4" placeholder="Highlight what makes your service, location, or hospitality special for travelers exploring Uganda...">{{ old('description') }}</textarea>
            </div>

            <!-- Section 3: Contact & Direct Channels -->
            <div class="form-section-title">
                <h3>3. Direct Contact & Booking Links</h3>
                <p>Help travelers reach your team directly via phone, WhatsApp, and official website.</p>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label for="contactInfo">Telephone / WhatsApp Number *</label>
                    <input type="text" name="contact" id="contactInfo" value="{{ old('contact') }}" placeholder="e.g. +256 772 000 000" required>
                </div>

                <div class="form-group">
                    <label for="website">Official Website URL (must start with https:// or http://)</label>
                    <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="https://yourbusiness.com">
                </div>
            </div>

            <!-- Section 4: Activities & Specific Add-on Fees -->
            <div class="form-section-title">
                <h3>4. Add-on Activities & Specific Offerings</h3>
                <p>Optional: List specific activities and fees (e.g. Guided Nature Walk, Boat Cruise, Bicycle Rental, Airport Transfer).</p>
            </div>

            <div id="activitiesContainer" class="activities-dynamic-list">
                <div class="activity-row">
                    <div class="activity-input-flex">
                        <input type="text" name="activities[0][name]" placeholder="Activity Name (e.g. Kazinga Boat Cruise)">
                        <input type="number" name="activities[0][fee_ugx]" placeholder="Fee in UGX" min="0">
                    </div>
                </div>
            </div>

            <div class="add-activity-btn-row">
                <button type="button" class="btn btn-sm btn-outline" id="addActivityBtn">
                    + Add Another Activity
                </button>
            </div>

            <div class="form-submit-row" style="margin-top: 2rem;">
                <button type="submit" class="btn btn-gold btn-lg">
                    Submit Property for Review &rarr;
                </button>
            </div>
        </form>
    @endguest
</div>

<script>
function previewListingPhoto(input) {
    const previewContainer = document.getElementById('photoPreviewContainer');
    const previewImg = document.getElementById('photoPreviewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    let activityIndex = 1;
    const addBtn = document.getElementById('addActivityBtn');
    const container = document.getElementById('activitiesContainer');

    if (addBtn && container) {
        addBtn.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'activity-row';
            row.innerHTML = `
                <div class="activity-input-flex">
                    <input type="text" name="activities[${activityIndex}][name]" placeholder="Activity Name">
                    <input type="number" name="activities[${activityIndex}][fee_ugx]" placeholder="Fee in UGX" min="0">
                    <button type="button" class="btn-remove-row" onclick="this.closest('.activity-row').remove()">&times;</button>
                </div>
            `;
            container.appendChild(row);
            activityIndex++;
        });
    }
});
</script>
@endsection
