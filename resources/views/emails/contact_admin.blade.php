<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Inquiry</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fc; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #FF5A00; color: #fff; padding: 20px; text-align: center; }
        .content { background: #fff; padding: 20px; }
        .footer { background: #0f172a; color: #fff; padding: 20px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Inquiry</h1>
        </div>
        <div class="content">
            <p>A new contact inquiry has been submitted.</p>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Phone:</strong> {{ $phone }}</p>
            <p><strong>Company:</strong> {{ $company }}</p>
            <p><strong>Product Interest:</strong> {{ $productInterest }}</p>
            <p><strong>Message:</strong> {{ $message }}</p>
            <p><strong>Submitted:</strong> {{ $submittedAt }}</p>
        </div>
        <div class="footer">
            <p>Fleming Fabtex | Khokhra, Ahmedabad, Gujarat | India</p>
        </div>
    </div>
</body>
</html>