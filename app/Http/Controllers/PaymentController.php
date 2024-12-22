<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class PaymentController extends Controller
{
    public function handlePaymentResponse(Request $request)
    {
        // Assuming you receive success data from Mpesa payment API
        $success = $request->input('success');
        $message = $request->input('message');
        $merchantRequestID = $request->input('MerchantRequestID');
        $checkoutRequestID = $request->input('CheckoutRequestID');

        // Process the payment response
        if ($success) {
            // Update the order status to 'paid' (or any appropriate status)
            // Assuming the phone number or some identifier is stored in the session
            $phoneNumber = Session::get('phone_number');
            $order = Order::where('phone_number', $phoneNumber)
                          ->where('status', 'pending')
                          ->first(); // Get the first pending order

            if ($order) {
                $order->status = 'paid';
                $order->save();
            }

            // Show success message and redirect to orders page after a few seconds
            return view('payment.success', compact('checkoutRequestID', 'merchantRequestID'));
        } else {
            // Show failure message
            return view('payment.failed', compact('message'));
        }
    }

    public function showOrders()
    {
        // Get the user's phone number or other identifying information from session
        $phoneNumber = Session::get('phone_number');
        
        // Fetch orders for the user
        $orders = Order::where('phone_number', $phoneNumber)->orderBy('created_at', 'desc')->get();
        
        // Return orders view
        return view('orders.index', compact('orders'));
    }
}
