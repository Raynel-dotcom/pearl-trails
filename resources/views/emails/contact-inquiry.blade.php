<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Pearl Trails Website Inquiry</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f7f1e3; color: #1d2a22; margin: 0; padding: 24px; line-height: 1.6; }
        .email-container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08); border: 1px solid #e5e7eb; }
        .email-header { background: #12301f; color: #ffffff; padding: 24px 30px; }
        .email-header h1 { margin: 0; font-size: 20px; font-weight: 700; color: #e8a317; letter-spacing: 0.05em; text-transform: uppercase; }
        .email-header p { margin: 4px 0 0; font-size: 13px; color: rgba(255,255,255,0.75); }
        .email-body { padding: 30px; }
        .field-row { margin-bottom: 16px; }
        .field-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #e8a317; margin-bottom: 4px; display: block; }
        .field-value { font-size: 15px; color: #12301f; font-weight: 600; }
        .message-box { background: #fdfbf7; border-left: 4px solid #e8a317; padding: 16px; border-radius: 8px; margin-top: 20px; font-size: 14.5px; color: #2d3748; white-space: pre-wrap; }
        .email-footer { background: #f9fafb; padding: 16px 30px; font-size: 12px; color: #6b7280; border-top: 1px solid #e5e7eb; text-align: center; }
        .reply-hint { display: inline-block; margin-top: 16px; padding: 8px 16px; background: #12301f; color: #e8a317 !important; text-decoration: none; border-radius: 9999px; font-size: 13px; font-weight: 700; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Pearl Trails</h1>
            <p>The Pearl of Africa — New Website Inquiry</p>
        </div>
        <div class="email-body">
            <div class="field-row">
                <span class="field-label">Sender Name</span>
                <span class="field-value">{{ $inquiry['name'] }}</span>
            </div>
            <div class="field-row">
                <span class="field-label">Email Address</span>
                <span class="field-value"><a href="mailto:{{ $inquiry['email'] }}" style="color: #12301f;">{{ $inquiry['email'] }}</a></span>
            </div>
            <div class="field-row">
                <span class="field-label">Subject</span>
                <span class="field-value">{{ $inquiry['subject'] }}</span>
            </div>
            <div class="field-row">
                <span class="field-label">Message</span>
                <div class="message-box">{{ $inquiry['message'] }}</div>
            </div>
            <p style="margin-top: 24px; font-size: 13px; color: #4b5563;">
                You can reply directly to this email to get in touch with <strong>{{ $inquiry['name'] }}</strong>.
            </p>
        </div>
        <div class="email-footer">
            Received via Pearl Trails Uganda contact form on {{ now()->format('l, F j, Y \a\t g:i A') }} EAT.
        </div>
    </div>
</body>
</html>
