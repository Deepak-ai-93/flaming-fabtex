<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quote Requested</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fc; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #FF5A00; color: #fff; padding: 20px; text-align: center; }
        .content { background: #fff; padding: 20px; }
        .footer { background: #0f172a; color: #fff; padding: 20px; text-align: center; font-size: 12px; }
        .quote-number { font-size: 20px; font-weight: bold; color: #FF5A00; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Quote Requested</h1>
        </div>
        <div class="content">
            <p>Your quote request has been received!</p>
            <p>Quote number: <span class="quote-number">{{ $quoteNumber }}</span></p>
            <p>Status: New</p>
            <p>The sales team will review your quote and contact you shortly.</p>
            <p>A copy has been sent to your email address.</p>
        </div>
        <div class="footer">
            <p>Fleming Fabtex | Khokhra, Ahmedabad, Gujarat | India</p>
        </div>
    </div>
</body>
</html>