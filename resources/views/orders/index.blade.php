<!-- resources/views/orders/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
</head>
<body>
    <h1>Your Orders</h1>

    @if($orders->isEmpty())
        <p>No orders found.</p>
    @else
        @foreach ($orders as $order)
            <div>
                <p>Order ID: {{ $order->id }}</p>
                <p>Customer Name: {{ $order->name }}</p>
                <p>Total Amount: {{ $order->total_amount }}</p>
                <p>Payment Method: {{ $order->payment_method }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Created At: {{ $order->created_at }}</p>
            </div>
        @endforeach
    @endif
</body>
</html>
