<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Product;
use App\Models\Order; // Add this line

class CartController extends Controller
{
    // Show cart page
    public function showCart()
    {
        // Retrieve all cart items stored in Redis
        $cart = Redis::hgetall('cart');
        $cartDetails = [];
        $totalAmount = 0; // Initialize the total amount

        // Fetch product details for each cart item
        foreach ($cart as $productId => $quantity) {
            // Fetch product details from the database
            $product = Product::find($productId);

            if ($product) {
                // Calculate total for each item
                $itemTotal = $product->price * $quantity;
                $totalAmount += $itemTotal; // Add item total to the overall total

                // Add product details along with quantity and total to the cart details array
                $cartDetails[] = [
                    'id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'category' => $product->category,
                    'description' => $product->description,
                    'gallery' => $product->gallery,
                    'quantity' => $quantity,
                    'total' => $itemTotal
                ];
            }
        }

        // Return the cart view with the product details and total amount
        return view('cart.index', compact('cartDetails', 'totalAmount'));
    }

    // Add product to the cart
    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1);

        // Retrieve the current quantity from Redis, or set to 0 if not yet added
        $currentQuantity = Redis::hget('cart', $productId);
        $newQuantity = $currentQuantity ? $currentQuantity + $quantity : $quantity;

        // Store the updated quantity in Redis
        Redis::hset('cart', $productId, $newQuantity);

        return redirect()->route('cart.show');
    }
    public function showCheckout()
    {
        $cart = Redis::hgetall('cart');
        $cartDetails = [];
        $totalAmount = 0;
    
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $itemTotal = $product->price * $quantity;
                $totalAmount += $itemTotal;
    
                $cartDetails[] = [
                    'id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];
            }
        }
    
        // Debug: check the total amount value
        dd($totalAmount); // This will show the value before rendering the view
    
        return view('checkout', compact('cartDetails', 'totalAmount'));
    }
    
    public function submitCheckout(Request $request)
    {
        // Validate the required fields
        $validated = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'payment_method' => 'required|string',
            'total' => 'required|numeric',
        ]);
    
        // Retrieve the validated data
        $name = $validated['name'];
        $phone_number = $validated['phone_number'];  // Phone number to store in session
        $payment_method = $validated['payment_method'];
        $totalAmount = $validated['total'];
    
        // Store the phone number in the session
        session(['phone_number' => $phone_number]);
    
        // Save the order to the database
        Order::create([
            'name' => $name,
            'phone_number' => $phone_number,
            'total_amount' => $totalAmount,
            'payment_method' => $payment_method,
            'status' => 'pending',
        ]);
    
        // Redirect back with success message
        return redirect()->route('checkout1.show')->with('success', 'Order placed successfully!');
    }
    
    

    // Remove item from cart
    public function removeFromCart($productId)
    {
        // Remove the product from the cart in Redis
        Redis::hdel('cart', $productId);
        return redirect()->route('cart.show');
    }
    public function updateQuantity(Request $request, $productId)
{
    $quantity = $request->input('quantity');
    
    // Update the cart in Redis with the new quantity
    Redis::hset('cart', $productId, $quantity);
    return redirect()->route('cart.show');
}
public function checkout()
{
    $cart = Redis::hgetall('cart');
    $cartDetails = [];
    $totalAmount = 0;

    foreach ($cart as $productId => $quantity) {
        $product = Product::find($productId);
        if ($product) {
            $itemTotal = $product->price * $quantity;
            $totalAmount += $itemTotal;

            $cartDetails[] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'category' => $product->category,
                'description' => $product->description,
                'gallery' => $product->gallery,
                'quantity' => $quantity,
                'total' => $itemTotal,
            ];
        }
    }

    return view('checkout', compact('cartDetails', 'totalAmount'));
}

}
