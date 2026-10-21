@extends('layouts.app')
@section('title', "Edit {$listing->name} - Vendor Portal")

@section('content')
<div class="vendor-form-container">
    <div class="page-hero">
        <span class="quiz-badge">Vendor Portal</span>
        <h1>Edit Listing: {{ $listing->name }}</h1>
        <p>Updating your business details will resubmit the listing for verification.</p>
    </div>

    @if($errors->any())
        <div class="alert-error-banner">
            <ul>
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendor.listings.update', $listing->id) }}" method="POST" class="vendor-listing-form">
        @csrf
        @method('PUT')

        <div class="form-section-title">
            <h3>1. Business Basics</h3>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <label for="businessType">Business Type *</label>
                <select name="type" id="businessType" required>
                    @foreach($listingTypes as $type)
                        <option value="{{ $type }}" {{ old('type', $listing->type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="businessName">Business Name *</label>
                <input type="text" name="name" id="businessName" value="{{ old('name', $listing->name) }}" required>
            </div>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <label for="destSelect">Destination</label>
                <select name="destination_id" id="destSelect">
                    <option value="">Specific Destination or Select "Other"...</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id', $listing->destination_id) == $dest->id ? 'selected' : '' }}>
                            {{ $dest->name }} ({{ $dest->region }} Uganda)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="customLocation">Custom Location / Town</label>
                <input type="text" name="custom_location" id="customLocation" value="{{ old('custom_location', $listing->custom_location) }}">
            </div>
        </div>

        <div class="form-section-title">
            <h3>2. Pricing & Description</h3>
        </div>

        <div class="form-group">
            <label for="priceUgx">Standard Price (UGX) *</label>
            <input type="number" name="price_ugx" id="priceUgx" value="{{ old('price_ugx', $listing->price_ugx) }}" required min="0">
        </div>

        <div class="form-group">
            <label for="description">Business Description</label>
            <textarea name="description" id="description" rows="4">{{ old('description', $listing->description) }}</textarea>
        </div>

        <div class="form-section-title">
            <h3>3. Contact & Website</h3>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <label for="contactInfo">Telephone / WhatsApp *</label>
                <input type="text" name="contact" id="contactInfo" value="{{ old('contact', $listing->contact) }}" required>
            </div>

            <div class="form-group">
                <label for="website">Website (must start with https:// or http://)</label>
                <input type="url" name="website" id="website" value="{{ old('website', $listing->website) }}">
            </div>
        </div>

        <!-- Activities and Fees -->
        <div class="form-section-title">
            <h3>4. Activities & Fees</h3>
        </div>

        <div id="activitiesContainer" class="activities-dynamic-list">
            @forelse($listing->activities as $idx => $act)
                <div class="activity-row">
                    <div class="activity-input-flex">
                        <input type="text" name="activities[{{ $idx }}][name]" value="{{ $act->name }}" placeholder="Activity Name">
                        <input type="number" name="activities[{{ $idx }}][fee_ugx]" value="{{ $act->fee_ugx }}" placeholder="Fee in UGX" min="0">
                        <button type="button" class="btn-remove-row" onclick="this.closest('.activity-row').remove()">✕</button>
                    </div>
                </div>
            @empty
                <div class="activity-row">
                    <div class="activity-input-flex">
                        <input type="text" name="activities[0][name]" placeholder="Activity Name">
                        <input type="number" name="activities[0][fee_ugx]" placeholder="Fee in UGX" min="0">
                    </div>
                </div>
            @endforelse
        </div>

        <div class="add-activity-btn-row">
            <button type="button" class="btn btn-sm btn-outline" id="addActivityBtn">
                + Add Another Activity
            </button>
        </div>

        <div class="form-submit-row">
            <button type="submit" class="btn btn-gold btn-lg">
                Save & Resubmit Listing
            </button>
            <a href="{{ route('vendor.listings') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let activityIndex = {{ count($listing->activities) + 1 }};
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
