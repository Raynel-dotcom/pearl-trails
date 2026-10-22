@extends('layouts.app')
@section('title', 'List Your Business - Partner with Pearl Trails Uganda')

@section('content')
<div class="vendor-form-container">
    <div class="page-hero">
        <span class="quiz-badge">Tourism Partner Network</span>
        <h1>List Your Uganda Tourism Business</h1>
        <p>Promote your hotel, safari lodge, hostel, restaurant, tourist site, or recreation centre to travelers exploring the Pearl of Africa.</p>
    </div>

    @if(session('success'))
        <div class="alert-success-banner">
            <span>✓ {{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error-banner">
            <ul>
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @guest
        <div class="auth-notice-card">
            <h3>Please Sign In or Create an Account</h3>
            <p>To register and manage your business listings, please log in or create a vendor account.</p>
            <div class="auth-notice-btns">
                <a href="{{ route('login') }}" class="btn btn-outline">Log In</a>
                <a href="{{ route('register') }}" class="btn btn-gold">Create Vendor Account</a>
            </div>
        </div>
    @else
        <form action="{{ route('list-business.store') }}" method="POST" class="vendor-listing-form">
            @csrf

            <div class="form-section-title">
                <h3>1. Business Basics</h3>
                <p>Categorize your tourism business.</p>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label for="businessType">Business Type *</label>
                    <select name="type" id="businessType" required>
                        <option value="">Select Category...</option>
                        @foreach($listingTypes as $type)
                            <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="businessName">Business Name *</label>
                    <input type="text" name="name" id="businessName" value="{{ old('name') }}" placeholder="e.g. Nile Rapids Adventure Camp" required>
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
                    <label for="customLocation">Other Area / Specific Town (e.g. Yumbe or Kireka)</label>
                    <input type="text" name="custom_location" id="customLocation" value="{{ old('custom_location') }}" placeholder="e.g. Yumbe Town, West Nile">
                </div>
            </div>

            <div class="form-section-title">
                <h3>2. Pricing & Experience</h3>
                <p>Set your transparent base price for travelers.</p>
            </div>

            <div class="form-group">
                <label for="priceUgx">Standard Price (in UGX) *</label>
                <input type="number" name="price_ugx" id="priceUgx" value="{{ old('price_ugx') }}" placeholder="Entrance fee, price per night, or typical meal spend in UGX" required min="0">
                <span class="field-hint">For stays: price per night. For food: typical spend per meal. For attractions: entry ticket.</span>
            </div>

            <div class="form-group">
                <label for="description">Business Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Highlight what makes your service or site special for visitors to Uganda...">{{ old('description') }}</textarea>
            </div>

            <div class="form-section-title">
                <h3>3. Contact & Web</h3>
                <p>Help travelers connect directly with your team.</p>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label for="contactInfo">Contact Telephone / WhatsApp *</label>
                    <input type="text" name="contact" id="contactInfo" value="{{ old('contact') }}" placeholder="e.g. +256 772 000 000" required>
                </div>

                <div class="form-group">
                    <label for="website">Website (must start with https:// or http://)</label>
                    <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="https://yourbusiness.com">
                </div>
            </div>

            <!-- Repeatable Activities and Fees Block -->
            <div class="form-section-title">
                <h3>4. Activities & Fees</h3>
                <p>Optional: List specific activities and fees (e.g., guided treks, boat cruises, equipment hire).</p>
            </div>

            <div id="activitiesContainer" class="activities-dynamic-list">
                <!-- Template row -->
                <div class="activity-row">
                    <div class="activity-input-flex">
                        <input type="text" name="activities[0][name]" placeholder="Activity Name (e.g. Kayaking Lesson)">
                        <input type="number" name="activities[0][fee_ugx]" placeholder="Fee in UGX" min="0">
                    </div>
                </div>
            </div>

            <div class="add-activity-btn-row">
                <button type="button" class="btn btn-sm btn-outline" id="addActivityBtn">
                    + Add Another Activity
                </button>
            </div>

            <div class="form-submit-row">
                <button type="submit" class="btn btn-gold btn-lg">
                    Submit Business for Approval
                </button>
            </div>
        </form>
    @endguest
</div>

<script>
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
                    <button type="button" class="btn-remove-row" onclick="this.closest('.activity-row').remove()">✕</button>
                </div>
            `;
            container.appendChild(row);
            activityIndex++;
        });
    }
});
</script>
@endsection
