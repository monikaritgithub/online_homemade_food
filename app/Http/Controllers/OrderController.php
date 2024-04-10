<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $validatedData = $request->validate([
            'chef_id' => 'required',
            'food_id' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
    
        // Set the 'customer_id' to the authenticated user's ID if authenticated, else set it to -1
        $validatedData['customer_id'] = Auth::check() ? Auth::id() : -1;
        session()->flash('success_message', 'Your order has been placed successfully!');

        // Create the order
        OrderItem::create($validatedData);
        $searchTerm = session('searchTerm');
        $products = Product::all(); 
        return redirect('/customer/cart/'.$validatedData['food_id']);
    }

    public function showOrders()
    {
        $userId = Auth::id();
        $orders = OrderItem::where('customer_id', $userId)->get();

        // Prepare data to pass to the view
        $orderData = [];
        foreach ($orders as $order) {
            $chef = User::find($order->chef_id);
            $food = Product::find($order->food_id);

            $orderData[] = [
                'id' => $order->id,
                'food_id' => $order->food_id,
                'chef_id' => $order->chef_id,
                'chef_name' => $chef ? $chef->name : 'Unknown Chef',
                'food_name' => $food ? $food->food_name : 'Unknown Food',
                'food_image' => $food ? $food->food_image : null,
                'payment_method' => $order->payment_method,
                'payment_status' => $order->payment_status,
                'status' => $order->status,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'created_at' => $order->created_at,
            ];
        }

        return view('customer.orders.showOrders', ['orders' => $orderData]);
    }

    public function createCartOrder(Request $request)
{
    // Retrieve cart items from the request
    $cartItems = $request->input('cart');

    // Loop through cart items and create an order for each item
    foreach ($cartItems as $itemId => $cartItem) {
        $order = new OrderItem();
        $order->customer_id = $cartItem['customer_id'];
        $order->chef_id = $cartItem['chef_id'];
        $order->food_id = $cartItem['product_id'];
        $order->payment_method = $cartItem['payment_method'];
        $order->payment_status = $cartItem['payment_status'];
        $order->quantity = $cartItem['quantity']; // Add quantity to the order
        $order->price = $cartItem['price'] * $cartItem['quantity']; // Calculate total price based on quantity
        
        // Save the order to the database
        $order->save();
    }

    // Flash success message
    session()->flash('success_message', 'Your order has been placed successfully!');

    // Redirect back to cart or any other page as needed
    return redirect('/customer/clear-mycart/');
}

      
}
