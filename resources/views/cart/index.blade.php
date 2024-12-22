<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome for Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2 {
            color: #333;
        }

        .cart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            flex-grow: 1;
            padding: 0 10px;
        }

        .cart-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
            width: 100%;
            max-width: 800px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease-in-out;
        }

        .cart-item:hover {
            transform: scale(1.02);
        }

        .cart-item img {
            max-width: 100px;
            border-radius: 10px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-details h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .cart-item-details p {
            color: #777;
            font-size: 14px;
        }

        .cart-item-price {
            font-size: 18px;
            color: #28a745;
            font-weight: bold;
        }

        .cart-item-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .remove-btn, .update-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 5px;
        }

        .remove-btn:hover, .update-btn:hover {
            background-color: #0056b3;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            font-size: 16px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .checkout-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #218838;
        }

        .cart-total {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        .continue-shopping {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            margin-top: 10px;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
        }

        .cart-header h2 {
            margin: 0;
            color: #333;
        }

        .cart-header i {
            font-size: 24px;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #28a745;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .cart-item {
                width: 100%;
                padding: 15px;
            }

            .cart-container {
                padding: 0 15px;
            }

            .checkout-btn {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>
<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">E-Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

   
    <!-- Main Cart Content -->
    <div class="cart-container">
        <div class="cart-header">
            <h2>Items in Your Cart</h2>
            <i class="fas fa-shopping-cart"></i>
        </div>

        @foreach($cartDetails as $cartItem)
            <div class="cart-item">
                <img src="{{ $cartItem['gallery'] }}" alt="{{ $cartItem['name'] }}">
                <div class="cart-item-details">
                    <h3>{{ $cartItem['name'] }}</h3>
                    <p>{{ $cartItem['category'] }}</p>
                    <p>{{ $cartItem['description'] }}</p>
                </div>
                <div class="cart-item-price">
                    ${{ number_format($cartItem['total'], 2) }}
                </div>
                <div class="cart-item-actions">
                    <form action="{{ route('cart.update', $cartItem['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" class="quantity-input" value="{{ $cartItem['quantity'] }}" min="1" required>
                        <button type="submit" class="update-btn">Update Quantity</button>
                    </form>
                    <form action="{{ route('cart.remove', $cartItem['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="cart-total">
            <span>Total: ${{ number_format($totalAmount, 2) }}</span>
        </div>

        <button class="checkout-btn" onclick="window.location.href='{{ route('checkout') }}'">Proceed to Checkout</button>

        <a href="#" class="continue-shopping">Continue Shopping</a>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Your Company. All Rights Reserved.</p>
    </footer>

</body>
</html>
