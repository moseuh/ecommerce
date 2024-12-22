<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});
Route::post("/login",[UserController::class,'login']);
Route::get("/",[ProductController::class,'index']);


Route::get('/products', [ProductController::class, 'index'])->name('products.index');


Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
// routes/web.php
// web.php
use App\Http\Controllers\PaymentController;

// Route to handle the payment response from Mpesa
Route::post('/payment/response', [PaymentController::class, 'handlePaymentResponse'])->name('payment.response');

// Route to display the user's orders
Route::get('/orders', [PaymentController::class, 'showOrders'])->name('orders');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

// Route to display the checkout page
Route::get('/checkout1', [CartController::class, 'checkout'])->name('checkout.show');

Route::post('/submit-checkout', [CartController::class, 'submitCheckout'])->name('submitCheckout');
Route::get('/order/{order}', [OrderController::class, 'showOrderStatus'])->name('orderStatus');

Route::put('/cart/update/{productId}', [CartController::class, 'updateQuantity'])->name('cart.update');

Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');



Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']); // List all orders
    Route::get('{id}', [OrderController::class, 'show']); // Show a specific order
    Route::post('/', [OrderController::class, 'store']); // Create a new order
    Route::put('{id}', [OrderController::class, 'update']); // Update an existing order
    Route::delete('{id}', [OrderController::class, 'destroy']); // Delete an order
});