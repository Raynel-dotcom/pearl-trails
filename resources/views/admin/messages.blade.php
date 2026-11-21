@extends('layouts.app')
@section('title', 'Admin Inquiries & Messages - Pearl Trails')

@section('content')
<div class="admin-listings-container">
    <div class="page-hero">
        <span class="quiz-badge">Administration Portal</span>
        <h1>Customer Inquiries &amp; Messages</h1>
        <p>View all website messages, traveler questions, and safari partnership inquiries submitted via the contact form.</p>
    </div>

    @if(session('success'))
        <div class="alert-success-banner">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Admin Section Tabs -->
    <div class="moderation-tabs-bar">
        <a href="{{ route('admin.listings') }}" class="tab-link">Vendor Listings</a>
        <a href="{{ route('admin.messages') }}" class="tab-link active">Customer Messages ({{ $messages->total() }})</a>
    </div>

    @if($messages->isEmpty())
        <div class="empty-state-card">
            <span class="empty-icon" aria-hidden="true">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </span>
            <h3>No customer messages yet</h3>
            <p>New inquiries submitted on the contact page will appear here instantly.</p>
        </div>
    @else
        <div class="admin-table-wrapper">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th style="width: 22%;">Sender</th>
                        <th style="width: 20%;">Subject</th>
                        <th style="width: 38%;">Message</th>
                        <th style="width: 10%;">Date</th>
                        <th style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                        <tr>
                            <td>
                                <strong>{{ $msg->name }}</strong>
                                <br>
                                <a href="mailto:{{ $msg->email }}" class="small-link" style="color: var(--gold); text-decoration: underline;">
                                    {{ $msg->email }}
                                </a>
                            </td>
                            <td>
                                <strong style="color: var(--forest); font-size: 0.92rem;">{{ $msg->subject }}</strong>
                            </td>
                            <td>
                                <div style="background: rgba(247, 241, 227, 0.5); padding: 0.6rem 0.8rem; border-radius: 8px; font-size: 0.88rem; line-height: 1.5; color: #2d3748; white-space: pre-wrap;">{{ $msg->message }}</div>
                            </td>
                            <td style="font-size: 0.82rem; color: #718096; white-space: nowrap;">
                                {{ $msg->created_at->format('M d, Y') }}<br>
                                <span style="font-size: 0.75rem;">{{ $msg->created_at->format('g:i A') }}</span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.4rem; align-items: center;">
                                    <a href="mailto:{{ $msg->email }}?subject={{ urlencode('Re: ' . $msg->subject) }}" 
                                       class="btn-vendor-outline" 
                                       style="padding: 0.3rem 0.6rem; font-size: 0.75rem; text-decoration: none;"
                                       title="Reply via Email">
                                        Reply
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-action-reject" 
                                                style="padding: 0.3rem 0.55rem; font-size: 0.75rem; cursor: pointer; background: #e53e3e; color: #fff; border: none; border-radius: 6px;"
                                                title="Delete Message">
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
