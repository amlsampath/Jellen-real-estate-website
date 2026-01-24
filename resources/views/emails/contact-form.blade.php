<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            border-bottom: 3px solid #10b981;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            color: #1f2937;
            font-size: 24px;
        }
        .field-group {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .field-value {
            color: #1f2937;
            font-size: 16px;
            padding: 10px;
            background-color: #f9fafb;
            border-left: 3px solid #10b981;
            border-radius: 4px;
        }
        .message-box {
            background-color: #f9fafb;
            border-left: 3px solid #10b981;
            padding: 15px;
            border-radius: 4px;
            white-space: pre-wrap;
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }
        .empty-value {
            color: #9ca3af;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
        </div>

        <div class="field-group">
            <div class="field-label">Full Name</div>
            <div class="field-value">{{ $name }}</div>
        </div>

        <div class="field-group">
            <div class="field-label">Email Address</div>
            <div class="field-value">
                <a href="mailto:{{ $email }}" style="color: #10b981; text-decoration: none;">{{ $email }}</a>
            </div>
        </div>

        <div class="field-group">
            <div class="field-label">Phone Number</div>
            <div class="field-value">
                @if($phone)
                    <a href="tel:{{ $phone }}" style="color: #10b981; text-decoration: none;">{{ $phone }}</a>
                @else
                    <span class="empty-value">Not provided</span>
                @endif
            </div>
        </div>

        <div class="field-group">
            <div class="field-label">Property Interest</div>
            <div class="field-value">
                @if($propertyInterest)
                    {{ $propertyInterest }}
                @else
                    <span class="empty-value">Not specified</span>
                @endif
            </div>
        </div>

        <div class="field-group">
            <div class="field-label">Message</div>
            <div class="message-box">{{ $messageContent }}</div>
        </div>

        <div class="footer">
            <p>This email was sent from the Govener Realty website contact form.</p>
            <p>You can reply directly to this email to respond to {{ $name }}.</p>
        </div>
    </div>
</body>
</html>
