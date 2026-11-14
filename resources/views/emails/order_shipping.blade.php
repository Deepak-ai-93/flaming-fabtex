<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Shipping Update</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fc; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #FF5A00; color: #fff; padding: 20px; text-align: center; }
        .content { background: #fff; padding: 20px; }
        .footer { background: #0f172a; color: #fff; padding: 20px; text-align: center; font-size: 12px; }
        .status-badge { display: inline-block; padding: 5px 10px; background: #e2e8f0; color: #1e293b; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Shipping Update</h1>
        </div>
        <div class="content">
            <p>Your order has shipped!</p>
            <p class="status-badge">Status: Shipped</p>
            <p>Track your order: <a href="{{ $trackingUrl }}" target="_blank">Track Order</a></p>
            <p>Estimated delivery: {{ $estimatedDelivery }}</p>
            <p>We'll continue to keep you updated.</p>
        </div>
        <div class="footer">
            <p>Fleming Fabtex | Khokhra, Ahmedabad, Gujarat | India</p>
        </div>
    </div>
</body>
</html>