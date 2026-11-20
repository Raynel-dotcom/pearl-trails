@extends('layouts.app')

@section('title', 'My Account - Member Dashboard | Pearl Trails')
@section('meta_description', 'Manage your Pearl Trails profile, saved Uganda safari itineraries, vendor business listings, and notification preferences.')

@section('content')
<div class="account-page-container">
    <!-- Header / Hero -->
    <div class="account-hero-card">
        <div class="account-hero-content">
            <div class="account-avatar-badge" aria-hidden="true">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="account-hero-text">
                <div class="account-badge-row">
                    @if($user->isAdmin())
                        <span class="role-pill role-admin">Administrator</span>
                    @elseif($user->isVendor())
                        <span class="role-pill role-vendor">Tourism Partner / Vendor</span>
                    @else
                        <span class="role-pill role-visitor">Travel Explorer</span>
                    @endif
                    <span class="member-since">Member since {{ $user->created_at->format('M Y') }}</span>
                </div>
                <h1>{{ $user->name }}</h1>
                <p class="account-email-sub">{{ $user->email }}</p>
            </div>
        </div>

        <div class="account-hero-actions">
            <a href="{{ route('plan') }}" class="btn-gold-pill">
                <span>Plan New Trip</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-account-logout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Alert Banners -->
    @if(session('status') === 'profile-updated')
        <div class="account-alert-banner alert-success" role="alert">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            <span>Your profile details have been successfully updated.</span>
        </div>
    @endif

    @if(session('status') === 'password-updated')
        <div class="account-alert-banner alert-success" role="alert">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            <span>Your password has been changed securely.</span>
        </div>
    @endif

    @if($errors->any())
        <div class="account-alert-banner alert-error" role="alert">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <div>
                <strong>Please check the errors below:</strong>
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Metric Summary Strip -->
    <div class="account-stats-strip">
        <div class="account-stat-item">
            <span class="stat-number">{{ $savedTrips->count() }}</span>
            <span class="stat-label">Saved Itineraries</span>
        </div>
        <div class="account-stat-item">
            <span class="stat-number">{{ $listings->count() }}</span>
            <span class="stat-label">Business Listings</span>
        </div>
        <div class="account-stat-item">
            <span class="stat-number">100%</span>
            <span class="stat-label">Profile Complete</span>
        </div>
        <div class="account-stat-item">
            <span class="stat-number">{{ session('currency', 'UGX') }}</span>
            <span class="stat-label">Active Currency</span>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="account-tabs-bar" role="tablist" aria-label="Account Panels">
        <button type="button" class="account-tab-btn active" onclick="switchAccountTab('overview', this)" role="tab" aria-selected="true" aria-controls="panelOverview">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            <span>Overview & Notifications</span>
        </button>

        <button type="button" class="account-tab-btn" onclick="switchAccountTab('saved', this)" role="tab" aria-selected="false" aria-controls="panelSaved">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
            <span>Saved Trips ({{ $savedTrips->count() }})</span>
        </button>

        <button type="button" class="account-tab-btn" onclick="switchAccountTab('listings', this)" role="tab" aria-selected="false" aria-controls="panelListings">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            <span>Business Listings ({{ $listings->count() }})</span>
        </button>

        <button type="button" class="account-tab-btn" onclick="switchAccountTab('settings', this)" role="tab" aria-selected="false" aria-controls="panelSettings">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span>Profile Settings</span>
        </button>

        <button type="button" class="account-tab-btn" onclick="switchAccountTab('security', this)" role="tab" aria-selected="false" aria-controls="panelSecurity">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <span>Security</span>
        </button>
    </div>

    <!-- PANEL 1: OVERVIEW & NOTIFICATIONS -->
    <div class="account-panel active" id="panelOverview" role="tabpanel">
        <div class="account-grid-2">
            <!-- Notifications Column -->
            <div class="account-card">
                <div class="card-header-row">
                    <span class="card-kicker-gold">Activity Feed</span>
                    <h3>Notifications & Travel Alerts</h3>
                </div>

                <div class="notification-list">
                    <!-- Notification 1 -->
                    <div class="notification-item unread">
                        <div class="notif-icon-circle gold-circle">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        </div>
                        <div class="notif-content">
                            <h4>Direct WhatsApp Concierge Active</h4>
                            <p>Have trip planning questions or need immediate travel assistance? You can chat with our team on WhatsApp at <strong>+256 772 068 901</strong>.</p>
                            <a href="https://wa.me/256772068901?text=Hello%20Pearl%20Trails%20Uganda%2C%20I%20am%20logged%20in%20and%20need%20assistance" target="_blank" rel="noopener" class="notif-link">
                                Open WhatsApp Chat &rarr;
                            </a>
                            <span class="notif-time">Always Active</span>
                        </div>
                    </div>

                    <!-- Notification 2 -->
                    <div class="notification-item">
                        <div class="notif-icon-circle green-circle">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <div class="notif-content">
                            <h4>UWA Gorilla & Chimpanzee Tracking Advisory</h4>
                            <p>Gorilla tracking permits for Bwindi Impenetrable NP & Mgahinga NP ($800 foreign non-resident / 300,000 UGX East African) require advance booking during high season.</p>
                            <span class="notif-time">Official Advisory</span>
                        </div>
                    </div>

                    @if($listings->count() > 0)
                        <!-- Notification 3 (For vendors) -->
                        <div class="notification-item">
                            <div class="notif-icon-circle blue-circle">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <div class="notif-content">
                                <h4>Business Listings Status</h4>
                                <p>You have {{ $listings->count() }} business property listed. {{ $listings->where('status', 'approved')->count() }} approved and visible on public browse cards.</p>
                                <span class="notif-time">Partner Update</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions & Travel Shortcuts -->
            <div class="account-card">
                <div class="card-header-row">
                    <span class="card-kicker-gold">Quick Navigation</span>
                    <h3>Travel Shortcuts</h3>
                </div>

                <div class="quick-actions-grid">
                    <a href="{{ route('plan') }}" class="quick-action-card">
                        <div class="action-icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                        </div>
                        <div>
                            <h4>Plan My Custom Trip</h4>
                            <p>Take the 7-step auto-advancing wizard to find ideal destinations for your budget.</p>
                        </div>
                    </a>

                    <a href="{{ route('destinations') }}" class="quick-action-card">
                        <div class="action-icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h4>Explore All 13 Destinations</h4>
                            <p>Filter by region, duration, and attractions with Google Maps navigation.</p>
                        </div>
                    </a>

                    <a href="{{ route('stays') }}" class="quick-action-card">
                        <div class="action-icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                        </div>
                        <div>
                            <h4>Hotels, Lodges & Camps</h4>
                            <p>Browse authentic unique stays with transparent pricing in {{ session('currency', 'UGX') }}.</p>
                        </div>
                    </a>

                    <a href="{{ route('list-your-business') }}" class="quick-action-card vendor-promo-action">
                        <div class="action-icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </div>
                        <div>
                            <h4>List a Tourism Business</h4>
                            <p>Post your lodge, restaurant, or activity with photos and reach global travelers.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL 2: SAVED TRIPS & ITINERARIES -->
    <div class="account-panel" id="panelSaved" role="tabpanel">
        <div class="account-card">
            <div class="card-header-row" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span class="card-kicker-gold">My Itineraries</span>
                    <h3>Saved Uganda Trips ({{ $savedTrips->count() }})</h3>
                </div>
                <a href="{{ route('plan') }}" class="btn-gold-pill" style="padding: 0.5rem 1.25rem;">
                    <span>+ New Trip</span>
                </a>
            </div>

            @if($savedTrips->isEmpty())
                <div class="account-empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="1.5"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    <h4>No saved trips yet</h4>
                    <p>Start planning your Uganda journey and bookmark destinations or custom itineraries to view them here anytime.</p>
                    <a href="{{ route('plan') }}" class="btn-gold-pill" style="margin-top: 1rem;">Start Trip Wizard &rarr;</a>
                </div>
            @else
                <div class="account-trips-grid">
                    @foreach($savedTrips as $trip)
                        <div class="account-trip-card">
                            @if($trip->destination && $trip->destination->image_path)
                                <div class="trip-card-media">
                                    <img src="{{ asset($trip->destination->image_path) }}" alt="{{ $trip->destination->name }}" loading="lazy">
                                </div>
                            @endif
                            <div class="trip-card-body">
                                <h4>{{ $trip->destination ? $trip->destination->name : 'Custom Safari' }}</h4>
                                <p class="trip-meta">{{ $trip->days ?? 3 }} Days &bull; Estimated {{ number_format($trip->total_cost_ugx ?? 0) }} UGX</p>
                                <div class="trip-card-actions">
                                    @if($trip->destination)
                                        <a href="{{ route('destinations.show', $trip->destination->slug) }}" class="btn-trip-view">View Details &rarr;</a>
                                    @endif
                                    <form method="POST" action="{{ route('saved.destroy', $trip->id) }}" onsubmit="return confirm('Remove this saved trip?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-trip-delete" title="Remove trip">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- PANEL 3: BUSINESS LISTINGS -->
    <div class="account-panel" id="panelListings" role="tabpanel">
        <div class="account-card">
            <div class="card-header-row" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span class="card-kicker-gold">Vendor Portal</span>
                    <h3>Your Registered Tourism Businesses</h3>
                </div>
                <a href="{{ route('list-your-business') }}" class="btn-gold-pill" style="padding: 0.5rem 1.25rem;">
                    <span>+ List Another Business</span>
                </a>
            </div>

            @if($listings->isEmpty())
                <div class="account-empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <h4>You haven't listed a business yet</h4>
                    <p>Are you a hotel manager, safari camp operator, restaurant owner, or adventure tour guide in Uganda? Reach travelers directly.</p>
                    <a href="{{ route('list-your-business') }}" class="btn-gold-pill" style="margin-top: 1rem;">
                        List Your Business Now &rarr;
                    </a>
                </div>
            @else
                <div class="account-listings-table-wrapper">
                    <table class="account-table">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Business Name</th>
                                <th>Category</th>
                                <th>Location / Destination</th>
                                <th>Base Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listings as $item)
                                <tr>
                                    <td>
                                        @if($item->image_path)
                                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="table-listing-thumb" loading="lazy">
                                        @else
                                            <div class="table-listing-thumb-placeholder">No pic</div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $item->name }}</strong>
                                        @if($item->website)
                                            <br><a href="{{ $item->website }}" target="_blank" rel="noopener" class="table-sub-link">Website &nearr;</a>
                                        @endif
                                    </td>
                                    <td><span class="category-pill">{{ $item->type }}</span></td>
                                    <td>{{ $item->destination ? $item->destination->name : ($item->custom_location ?: 'Uganda') }}</td>
                                    <td>{{ number_format($item->price_ugx) }} UGX</td>
                                    <td>
                                        @if($item->status === 'approved')
                                            <span class="status-pill status-approved">Approved &bull; Live</span>
                                        @elseif($item->status === 'rejected')
                                            <span class="status-pill status-rejected">Needs Revision</span>
                                        @else
                                            <span class="status-pill status-pending">Pending Review</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('vendor.listings.edit', $item->id) }}" class="btn-table-edit">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- PANEL 4: PROFILE SETTINGS -->
    <div class="account-panel" id="panelSettings" role="tabpanel">
        <div class="account-card" style="max-width: 680px; margin: 0 auto;">
            <div class="card-header-row">
                <span class="card-kicker-gold">Personal Information</span>
                <h3>Profile Settings</h3>
                <p style="color: rgba(247, 241, 227, 0.75); font-size: 0.9rem; margin-top: 0.25rem;">Update your account name and email address.</p>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="account-form">
                @csrf
                @method('PATCH')

                <div class="account-form-group">
                    <label for="profile_name" class="account-form-label">Full Name <span style="color: var(--gold);">*</span></label>
                    <input type="text" id="profile_name" name="name" class="account-form-input" value="{{ old('name', $user->name) }}" required autocomplete="name">
                </div>

                <div class="account-form-group">
                    <label for="profile_email" class="account-form-label">Email Address <span style="color: var(--gold);">*</span></label>
                    <input type="email" id="profile_email" name="email" class="account-form-input" value="{{ old('email', $user->email) }}" required autocomplete="email">
                </div>

                <div class="account-form-group">
                    <label class="account-form-label">Account Role</label>
                    <input type="text" class="account-form-input" value="{{ ucfirst($user->role) }}" disabled style="opacity: 0.6; cursor: not-allowed;">
                    <span style="font-size: 0.78rem; color: rgba(247, 241, 227, 0.6); margin-top: 0.35rem; display: block;">Role automatically upgrades to Vendor upon submitting your first business listing.</span>
                </div>

                <div style="margin-top: 1.75rem;">
                    <button type="submit" class="btn-gold-pill" style="border: none; cursor: pointer; padding: 0.75rem 2rem;">
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PANEL 5: SECURITY -->
    <div class="account-panel" id="panelSecurity" role="tabpanel">
        <div class="account-card" style="max-width: 680px; margin: 0 auto;">
            <div class="card-header-row">
                <span class="card-kicker-gold">Security Credentials</span>
                <h3>Change Password</h3>
                <p style="color: rgba(247, 241, 227, 0.75); font-size: 0.9rem; margin-top: 0.25rem;">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="account-form">
                @csrf
                @method('PUT')

                <div class="account-form-group">
                    <label for="current_password" class="account-form-label">Current Password <span style="color: var(--gold);">*</span></label>
                    <input type="password" id="current_password" name="current_password" class="account-form-input" required autocomplete="current-password">
                </div>

                <div class="account-form-group">
                    <label for="password" class="account-form-label">New Password <span style="color: var(--gold);">*</span></label>
                    <input type="password" id="password" name="password" class="account-form-input" required autocomplete="new-password" placeholder="At least 8 characters">
                </div>

                <div class="account-form-group">
                    <label for="password_confirmation" class="account-form-label">Confirm New Password <span style="color: var(--gold);">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="account-form-input" required autocomplete="new-password">
                </div>

                <div style="margin-top: 1.75rem;">
                    <button type="submit" class="btn-gold-pill" style="border: none; cursor: pointer; padding: 0.75rem 2rem;">
                        <span>Update Password</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function switchAccountTab(tabKey, btnElement) {
        document.querySelectorAll('.account-tab-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.setAttribute('aria-selected', 'false');
        });
        document.querySelectorAll('.account-panel').forEach(panel => {
            panel.classList.remove('active');
        });

        btnElement.classList.add('active');
        btnElement.setAttribute('aria-selected', 'true');

        const targetPanel = document.getElementById('panel' + tabKey.charAt(0).toUpperCase() + tabKey.slice(1));
        if (targetPanel) {
            targetPanel.classList.add('active');
        }
    }
</script>
@endsection
