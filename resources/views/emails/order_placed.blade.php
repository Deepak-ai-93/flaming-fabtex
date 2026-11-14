<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Placed</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fc; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #FF5A00; color: #fff; padding: 20px; text-align: center; }
        .content { background: #fff; padding: 20px; }
        .footer { background: #0f172a; color: #fff; padding: 20px; text-align: center; font-size: 12px; }
        .button { display: inline-block; background: #FF5A00; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .order-number { font-size: 24px; font-weight: bold; color: #FF5A00; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Placed</h1>
        </div>
        <div class="content">
            <p>Thank you for your order!</p>
            <p>Your order number is: <span class="order-number">{{ $orderNumber }}</span></p>
            <p>Status: Processing</p>
            <p>We'll send you updates as your order progresses.</p>
            <a href="{{ $baseUrl }}/my-account/orders/{{ $orderNumber }}" class="button">Track Order</a>
        </div>
        <div class="footer">
            <p>Fleming Fabtex | Khokhra, Ahmedabad, Gujarat | India</p>
            <p>If you have any questions, reply to this email.</p>
        </div>
    </div>
</body>
</html>