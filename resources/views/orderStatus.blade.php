<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
</head>
<body>

<h1>Order Status</h1>

<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Name:</strong> {{ $order->name }}</p>
<p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
<p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
<p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

</body>
</html>
