<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Session;
use Redis;
use App\Models\Product;

class OrderController extends Controller
{
    // Show the checkout form with the total amount
    public function showCheckoutForm()
    {session(['phone_number' => $phoneNumber]); 
        // Get the total amount from the session 
        $totalAmount = session('cart_total');
        
        return view('checkout', compact('totalAmount'));
    }

    // Show checkout page with cart details and total amount
    public function showCheckout()
    {
        // Retrieve cart items from Redis
        $cart = Redis::hgetall('cart');
        $cartDetails = [];
        $totalAmount = 0;

        // Calculate total and fetch product details
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                // Calculate the total price for this product
                $itemTotal = $product->price * $quantity;
                $totalAmount += $itemTotal;

                // Add product details to cart
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

        // Debug the total amount to ensure it's calculated correctly
        dd($totalAmount);

        // Pass total amount and cart details to the view
        return view('checkout.index', compact('cartDetails', 'totalAmount'));
    }

    // Handle the form submission for checkout
    public function submitCheckoutForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'payment_method' => 'required|in:mpesa,cash',
            'total_amount' => 'required|numeric', // Ensure total amount is present in the request
        ]);

        // Save the phone number in session
        session(['phone_number' => $request->phone_number]);

        // Create the order
        $order = new Order();
        $order->name = $request->name;
        $order->phone_number = $request->phone_number;
        $order->total_amount = $request->total_amount;
        $order->payment_method = $request->payment_method;
        $order->status = 'pending'; // Initially set to pending
        $order->save();

        // Redirect to the order confirmation page with the order ID
        return redirect()->route('orderStatus', ['order' => $order->id]);
    }

    // Display a list of orders based on the phone number stored in the session
    public function index()
{
    // Get the phone number from the session
    $phoneNumber = session('phone_number');

    // If phone number is available, query orders for that phone number
    if ($phoneNumber) {
        $orders = Order::where('phone_number', $phoneNumber)->get(); // This returns a Collection
    } else {
        // If no phone number is in session, return empty collection
        $orders = collect();
    }

    // Pass orders to the view
    return view('orders.index', compact('orders'));
}

}
