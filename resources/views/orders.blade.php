<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Order Management</a>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Order Management</h1>

        <!-- Create Order Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Create New Order</h5>
            </div>
            <div class="card-body">
                <form id="createOrderForm">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" placeholder="Enter customer name" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Customer Email</label>
                        <input type="email" class="form-control" id="customerEmail" placeholder="Enter customer email" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerPhone" class="form-label">Customer Phone</label>
                        <input type="text" class="form-control" id="customerPhone" placeholder="Enter customer phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="orderItems" class="form-label">Order Items (JSON Format)</label>
                        <textarea class="form-control" id="orderItems" rows="3" placeholder='e.g., [{"product_id":1,"quantity":2}]' required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="totalPrice" class="form-label">Total Price</label>
                        <input type="number" class="form-control" id="totalPrice" placeholder="Enter total price" step="0.01" required>
                    </div>
                    <button type="button" class="btn btn-success w-100" onclick="createOrder()">Create Order</button>
                </form>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card">
            <div class="card-header">
                <h5>Orders</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Items</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTable">
                        <!-- Orders will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Order Management System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Fetch and display orders
        function fetchOrders() {
            axios.get('/api/orders')
                .then(response => {
                    const orders = response.data;
                    const tableBody = document.getElementById('ordersTable');
                    tableBody.innerHTML = '';
                    orders.forEach(order => {
                        const row = `
                            <tr>
                                <td>${order.id}</td>
                                <td>${order.customer_name}</td>
                                <td>${order.customer_email}</td>
                                <td>${order.customer_phone}</td>
                                <td>${JSON.stringify(order.items)}</td>
                                <td>$${order.total_price.toFixed(2)}</td>
                                <td>${order.status}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="updateOrder(${order.id}, 'processing')">Mark as Processing</button>
                                    <button class="btn btn-success btn-sm" onclick="updateOrder(${order.id}, 'delivered')">Mark as Delivered</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteOrder(${order.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error(error));
        }

        // Create an order
        function createOrder() {
            const data = {
                customer_name: document.getElementById('customerName').value,
                customer_email: document.getElementById('customerEmail').value,
                customer_phone: document.getElementById('customerPhone').value,
                items: JSON.parse(document.getElementById('orderItems').value),
                total_price: parseFloat(document.getElementById('totalPrice').value),
            };

            axios.post('/api/orders', data)
                .then(() => {
                    fetchOrders();
                    document.getElementById('createOrderForm').reset();
                    alert('Order created successfully!');
                })
                .catch(error => console.error(error));
        }

        // Update an order's status
        function updateOrder(id, status) {
            axios.put(`/api/orders/${id}`, { status })
                .then(() => {
                    fetchOrders();
                    alert(`Order marked as ${status}!`);
                })
                .catch(error => console.error(error));
        }

        // Delete an order
        function deleteOrder(id) {
            axios.delete(`/api/orders/${id}`)
                .then(() => {
                    fetchOrders();
                    alert('Order deleted successfully!');
                })
                .catch(error => console.error(error));
        }

        // Initial fetch
        fetchOrders();
    </script>
</body>
</html>
