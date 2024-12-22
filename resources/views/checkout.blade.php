<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome for Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
               /* Checkout Page Styles */
        .checkout-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .order-summary, .checkout-form {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 48%;
            box-sizing: border-box;
        }

        /* Make cards full width on smaller screens */
        @media (max-width: 768px) {
            .order-summary, .checkout-form {
                width: 100%;
            }
        }

        .order-summary h3 {
            margin-bottom: 10px;
            text-align: center;
        }

        .order-summary ul {
            list-style-type: none;
            padding: 0;
        }

        .order-summary li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

  /* Checkout Page Styles */
                .checkout-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .order-summary, .checkout-form {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 48%;
            box-sizing: border-box;
        }

        /* Make cards full width on smaller screens */
        @media (max-width: 768px) {
            .order-summary, .checkout-form {
                width: 100%;
            }
        }

        .order-summary h3 {
            margin-bottom: 10px;
            text-align: center;
        }

        .order-summary ul {
            list-style-type: none;
            padding: 0;
        }

        .order-summary li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus, select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        button {
            padding: 8px 18px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .total-amount {
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
        }

        /* Popup modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
            text-align: center;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            box-sizing: border-box;
        }

        .modal-header {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .modal-body {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .green-tick {
            color: green;
            font-size: 30px;
        }

        .close-btn {
            font-size: 20px;
            color: #aaa;
            cursor: pointer;
        }

        .close-btn:hover {
            color: black;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
    <div class="checkout-container">
    <!-- Order Summary Card -->
    <div class="order-summary">
        <h3>Order Summary</h3>
        <ul>
            <!-- Display each item in cart -->
            @foreach($cartDetails as $item)
                <li>
                    <strong>{{ $item['name'] }}</strong><br>
                    Category: {{ $item['category'] }}<br>
                    Price: ${{ $item['price'] }}<br>
                    Quantity: {{ $item['quantity'] }}<br>
                    Total: ${{ $item['total'] }}
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Checkout Form Card -->
    <div class="checkout-form">
        <form id="checkoutForm" action="/submitCheckout" method="POST">
            <!-- CSRF Token for Laravel -->
            <input type="hidden" name="_token" value="CSRF_TOKEN">

            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="mpesa">Mpesa</option>
                    <option value="cash">Cash</option>
                </select>
            </div>

            <input type="hidden" name="total" value="50"> <!-- Example Total Amount -->

            <button type="submit">Place Order</button>
        </form>
    </div>
</div>

<!-- Popup Modal -->
<div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div id="modalHeader"></div>
        <div id="modalBody"></div>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 My Website | All Rights Reserved</p>
</footer>

<script>
    // JavaScript for handling form submission and showing the popup modal
    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        var paymentMethod = document.getElementById('payment_method').value;

        // If payment method is 'mpesa', send the data to the Mpesa API
        if (paymentMethod === 'mpesa') {
            // Get phone number and total amount from the form
            var phone_number = document.getElementById('phone_number').value;
            var totalAmount = document.querySelector('input[name="total"]').value;

            // Prepare data to send to Mpesa using fetch API
            var data = new FormData();
            data.append('phone_number', phone_number);
            data.append('amount', totalAmount);

            // Send data to Mpesa using fetch
            fetch('https://dialapadafrica.co.ke/mpesa/stk.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                // Show the appropriate popup based on success or failure
                var popupModal = document.getElementById('popupModal');
                var modalHeader = document.getElementById('modalHeader');
                var modalBody = document.getElementById('modalBody');

                if (data.success === true) {
                    modalHeader.innerHTML = 'Payment Successful';
                    modalBody.innerHTML = 
                        <div class="green-tick">&#10004;</div>
                        <p>Payment initiated successfully!</p>
                        <p>Checkout Request ID: ${data.CheckoutRequestID}</p>
                        <p>Merchant Request ID: ${data.MerchantRequestID}</p>
                    ;
                } else {
                    modalHeader.innerHTML = 'Payment Failed';
                    modalBody.innerHTML = 
                        <div class="green-tick">&#10060;</div>
                        <p>Mpesa payment failed. Please try again.</p>
                    ;
                }

                popupModal.style.display = 'block'; // Show the modal
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing the Mpesa payment. Please try again.');
            });
        } else {
            // If the payment method is not Mpesa, just submit the form normally
            this.submit();
        }
    });

    // Close the popup modal when the user clicks on the close button
    document.querySelector('.close-btn').addEventListener('click', function() {
        document.getElementById('popupModal').style.display = 'none';
    });

    // Close the modal if the user clicks anywhere outside of the modal content
    window.onclick = function(event) {
        if (event.target === document.getElementById('popupModal')) {
            document.getElementById('popupModal').style.display = 'none';
        }
    };
</script>
 
  

</body>
</html>
