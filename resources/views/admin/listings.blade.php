@extends('layouts.app')
@section('title', 'Admin Listing Moderation - Pearl Trails')

@section('content')
<div class="admin-listings-container">
    <div class="page-hero">
        <span class="quiz-badge">Administration Portal</span>
        <h1>Vendor Listing Moderation</h1>
        <p>Review, verify, approve, reject, or remove vendor submissions across Uganda.</p>
    </div>

    @if(session('success'))
        <div class="alert-success-banner">
            <span>✓ {{ session('success') }}</span>
        </div>
    @endif

    <!-- Moderation Tabs -->
    <div class="moderation-tabs-bar">
        <a href="{{ route('admin.listings') }}" class="tab-link {{ empty($status) ? 'active' : '' }}">All Submissions</a>
        <a href="{{ route('admin.listings', ['status' => 'pending']) }}" class="tab-link {{ $status === 'pending' ? 'active' : '' }}">Pending Review</a>
        <a href="{{ route('admin.listings', ['status' => 'approved']) }}" class="tab-link {{ $status === 'approved' ? 'active' : '' }}">Approved</a>
        <a href="{{ route('admin.listings', ['status' => 'rejected']) }}" class="tab-link {{ $status === 'rejected' ? 'active' : '' }}">Rejected</a>
    </div>

    @if($listings->isEmpty())
        <div class="empty-state-card">
            <div class="empty-icon-wrap">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <h3>No submissions found in this category</h3>
        </div>
    @else
        <div class="admin-table-wrapper">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Business</th>
                        <th>Type</th>
                        <th>Vendor</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Activities</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listings as $listing)
                        <tr>
                            <td>
                                <strong>{{ $listing->name }}</strong>
                                <p class="table-desc">{{ Str::limit($listing->description, 80) }}</p>
                                @if($listing->website)
                                    <a href="{{ $listing->website }}" target="_blank" class="small-link">Website ↗</a>
                                @endif
                                <span class="contact-text">Tel: {{ $listing->contact }}</span>
                            </td>
                            <td><span class="type-pill">{{ $listing->type }}</span></td>
                            <td>{{ $listing->user->name ?? 'User' }} ({{ $listing->user->email ?? 'N/A' }})</td>
                            <td>{{ $listing->destination->name ?? ($listing->custom_location ?? 'Other') }}</td>
                            <td>@price($listing->price_ugx)</td>
                            <td>
                                @if($listing->activities->count() > 0)
                                    <ul class="admin-act-list">
                                        @foreach($listing->activities as $act)
                                            <li>{{ $act->name }}: @price($act->fee_ugx)</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td>
                                @if($listing->status === 'approved')
                                    <span class="badge-status-approved">Approved</span>
                                @elseif($listing->status === 'pending')
                                    <span class="badge-status-pending">Pending</span>
                                @else
                                    <span class="badge-status-rejected">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <div class="admin-actions-flex">
                                    @if($listing->status !== 'approved')
                                        <form action="{{ route('admin.listings.approve', $listing->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-primary">
                                                Approve
                                            </button>
                                        </form>
                                    @endif

                                    @if($listing->status !== 'rejected')
                                        <form action="{{ route('admin.listings.reject', $listing->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-outline-warning">
                                                Reject
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.listings.destroy', $listing->id) }}" method="POST" onsubmit="return confirm('Permanently delete this business listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrapper" style="margin-top: 1.5rem;">
                {{ $listings->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
