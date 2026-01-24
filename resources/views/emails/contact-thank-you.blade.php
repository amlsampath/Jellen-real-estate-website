<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Govener Realty</title>
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
            border-bottom: 3px solid #a9c638;
            padding-bottom: 20px;
            margin-bottom: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #1f2937;
            font-size: 28px;
        }
        .content {
            margin-bottom: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            font-size: 16px;
            color: #374151;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .highlight-box {
            background-color: #f0f9ff;
            border-left: 4px solid #a9c638;
            padding: 20px;
            border-radius: 4px;
            margin: 25px 0;
        }
        .highlight-box p {
            margin: 0;
            color: #1f2937;
            font-size: 16px;
            line-height: 1.6;
        }
        .contact-info {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .contact-info h3 {
            margin: 0 0 15px 0;
            color: #1f2937;
            font-size: 18px;
        }
        .contact-item {
            margin-bottom: 12px;
            font-size: 15px;
            color: #374151;
        }
        .contact-item strong {
            color: #1f2937;
            margin-right: 8px;
        }
        .contact-item a {
            color: #a9c638;
            text-decoration: none;
        }
        .contact-item a:hover {
            text-decoration: underline;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
            text-align: center;
        }
        .signature {
            margin-top: 25px;
            font-size: 16px;
            color: #1f2937;
        }
        .signature strong {
            color: #1f2937;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Thank You for Contacting Us!</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $name }},
            </div>

            <div class="message">
                <p>Thank you for reaching out to Govener Realty. We have successfully received your contact form submission and appreciate you taking the time to get in touch with us.</p>
            </div>

            <div class="highlight-box">
                <p><strong>What happens next?</strong></p>
                <p style="margin-top: 10px;">Our team of property investment specialists will review your inquiry and get back to you within 24 hours with personalized guidance tailored to your property goals.</p>
            </div>

            <div class="message">
                <p>We're committed to helping you make informed property investment decisions and look forward to assisting you on your property journey.</p>
            </div>

            <div class="contact-info">
                <h3>Our Contact Information</h3>
                <div class="contact-item">
                    <strong>Phone:</strong>
                    <a href="tel:0482449449">0482 449 449</a>
                </div>
                <div class="contact-item">
                    <strong>Email:</strong>
                    <a href="mailto:jellen@govenerrealty.com.au">jellen@govenerrealty.com.au</a>
                </div>
                <div class="contact-item">
                    <strong>Office:</strong>
                    Piara Waters, Perth 6112, Australia
                </div>
            </div>

            <div class="signature">
                <p>Best regards,<br>
                <strong>The Govener Realty Team</strong></p>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated confirmation email. Please do not reply to this message.</p>
            <p>If you have any urgent questions, please contact us directly at <a href="tel:0482449449" style="color: #a9c638;">0482 449 449</a>.</p>
        </div>
    </div>
</body>
</html>

