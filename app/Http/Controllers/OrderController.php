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
        ]);
    
        // Set the 'customer_id' to the authenticated user's ID if authenticated, else set it to -1
        $validatedData['customer_id'] = Auth::check() ? Auth::id() : -1;
    
        // Create the order
        OrderItem::create($validatedData);
        $searchTerm = session('searchTerm');
        $products = Product::all(); 
        return view('customer.products.index', ['products' => $products,'searchTerm' => $searchTerm]);
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
                'chef_name' => $chef ? $chef->name : 'Unknown Chef',
                'food_name' => $food ? $food->food_name : 'Unknown Food',
                'food_image' => $food ? $food->food_image : null,
                'payment_method' => $order->payment_method,
                'payment_status' => $order->payment_status,
                'price' => $order->price,
            ];
        }

        return view('customer.orders.showOrders', ['orders' => $orderData]);
    }
      
}
