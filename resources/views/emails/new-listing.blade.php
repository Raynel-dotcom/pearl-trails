<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Business Listed on Pearl Trails</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f7f1e3; color: #1d2a22; margin: 0; padding: 24px; line-height: 1.6; }
        .email-container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08); border: 1px solid #e5e7eb; }
        .email-header { background: #12301f; color: #ffffff; padding: 24px 30px; }
        .email-header h1 { margin: 0; font-size: 20px; font-weight: 700; color: #e8a317; letter-spacing: 0.05em; text-transform: uppercase; }
        .email-header p { margin: 4px 0 0; font-size: 13px; color: rgba(255,255,255,0.75); }
        .email-body { padding: 30px; }
        .badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 700; text-transform: uppercase; border-radius: 9999px; background: rgba(232, 163, 23, 0.15); color: #b47a06; margin-bottom: 16px; }
        .field-row { margin-bottom: 14px; }
        .field-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #e8a317; margin-bottom: 3px; display: block; }
        .field-value { font-size: 15px; color: #12301f; font-weight: 600; }
        .details-box { background: #fdfbf7; border-left: 4px solid #e8a317; padding: 14px 16px; border-radius: 8px; margin-top: 16px; font-size: 14px; color: #2d3748; }
        .cta-btn { display: inline-block; margin-top: 24px; padding: 12px 24px; background: #e8a317; color: #12301f !important; text-decoration: none; border-radius: 9999px; font-size: 14px; font-weight: 700; text-align: center; }
        .email-footer { background: #f9fafb; padding: 16px 30px; font-size: 12px; color: #6b7280; border-top: 1px solid #e5e7eb; text-align: center; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Pearl Trails</h1>
            <p>New Business Registration Pending Review</p>
        </div>
        <div class="email-body">
            <span class="badge">Status: Pending Moderation</span>

            <div class="field-row">
                <span class="field-label">Business Name</span>
                <span class="field-value">{{ $listing->name }}</span>
            </div>

            <div class="field-row">
                <span class="field-label">Category / Type</span>
                <span class="field-value">{{ $listing->type }}</span>
            </div>

            <div class="field-row">
                <span class="field-label">Location / Destination</span>
                <span class="field-value">
                    {{ $listing->destination?->name ?? $listing->custom_location ?? 'Uganda' }}
                </span>
            </div>

            <div class="field-row">
                <span class="field-label">Starting Price</span>
                <span class="field-value">UGX {{ number_format($listing->price_ugx) }}</span>
            </div>

            <div class="field-row">
                <span class="field-label">Contact Details</span>
                <span class="field-value">{{ $listing->contact }}</span>
            </div>

            @if($listing->website)
                <div class="field-row">
                    <span class="field-label">Website</span>
                    <span class="field-value"><a href="{{ $listing->website }}" target="_blank" style="color: #12301f;">{{ $listing->website }}</a></span>
                </div>
            @endif

            @if($listing->description)
                <div class="field-row">
                    <span class="field-label">Description</span>
                    <div class="details-box">{{ $listing->description }}</div>
                </div>
            @endif

            @if($listing->activities->isNotEmpty())
                <div class="field-row" style="margin-top: 16px;">
                    <span class="field-label">Offered Activities / Add-ons</span>
                    <ul style="margin: 6px 0 0; padding-left: 20px; font-size: 14px; color: #374151;">
                        @foreach($listing->activities as $act)
                            <li><strong>{{ $act->name }}</strong> (UGX {{ number_format($act->fee_ugx) }})</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="text-align: center; margin-top: 24px;">
                <a href="{{ url('/admin/listings') }}" class="cta-btn">
                    Review &amp; Approve in Admin Panel &rarr;
                </a>
            </div>
        </div>
        <div class="email-footer">
            Submitted via Pearl Trails Uganda partner portal on {{ now()->format('l, F j, Y \a\t g:i A') }} EAT.
        </div>
    </div>
</body>
</html>
