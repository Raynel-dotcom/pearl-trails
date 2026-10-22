<x-guest-layout>
    <x-slot name="title">Verify Email</x-slot>

    <div class="auth-header-text">
        <h2>Verify Your Email</h2>
        <p>Thanks for joining Pearl Trails! Before getting started, please check your inbox and click the verification link we just emailed to you.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="auth-status-alert">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>A fresh verification link has been sent to your email address.</span>
        </div>
    @endif

    <div class="auth-verify-actions">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-gold btn-block auth-submit-btn">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="auth-footer-prompt">
            @csrf
            <span>Signed into the wrong account?</span>
            <button type="submit" class="auth-action-link" style="background: none; border: none; cursor: pointer; font-family: inherit; font-size: inherit; padding: 0;">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
