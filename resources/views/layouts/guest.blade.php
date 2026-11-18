@extends('layouts.app')
@section('title', config('app.name', 'Pearl Trails') . ' — Authentication')

@section('content')
<div class="auth-page-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <a href="{{ route('home') }}" class="auth-brand-mark" aria-label="Pearl Trails Home">
                <svg width="28" height="28" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                    <path d="M4 38L18 14L28 30L34 20L44 38H4Z" stroke="var(--gold)" stroke-width="2.5" stroke-linejoin="round"/>
                    <path d="M12 38L22 22L30 38" stroke="var(--gold-soft)" stroke-width="1.8" stroke-linejoin="round"/>
                    <circle cx="37" cy="12" r="4" fill="var(--gold)"/>
                </svg>
            </a>
            <span class="auth-kicker">Member Access</span>
            <h1 class="auth-title">Account Assistance</h1>
        </div>

        <div class="auth-guest-content">
            {{ $slot }}
        </div>
    </div>
</div>
@endsection
