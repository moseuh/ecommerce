<!-- payment/success.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <div>
        <h2>Payment Successful!</h2>
        <div style="color: green; font-size: 30px;">&#10004;</div>
        <p>Payment initiated successfully!</p>
        <p>Checkout Request ID: {{ $checkoutRequestID }}</p>
        <p>Merchant Request ID: {{ $merchantRequestID }}</p>
        <p>Redirecting to your orders...</p>

        <script>
            // Redirect to orders page after 3 seconds
            setTimeout(() => {
                window.location.href = "{{ route('orders') }}";
            }, 3000);
        </script>
    </div>
</body>
</html>
