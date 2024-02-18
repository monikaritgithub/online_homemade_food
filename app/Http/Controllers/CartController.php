<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;



class CartController extends Controller
{
    public function viewCart($productId)
    {
       // Retrieve product details with the corresponding chief information using join
       $productDetails = DB::table('products')
       ->join('users', 'products.chief_id', '=', 'users.id')
       ->select(
           'products.id as product_id',
           'products.food_name',
           'products.food_price',
           'products.food_image',
           'products.food_descriptions',
           'products.category_tag',
           'products.is_available',
           'users.id as chief_id',
           'users.email as email',
           'users.contactno as contactno',
           'users.name as name',
           'users.location as location',
           'users.profile_photo_path'
       )
       ->where('products.id', '=', $productId)
       ->first();
   // Check if the product is found
   if (!$productDetails) {
       return response()->json(['error' => 'Product not found'], 404);
   }

   // Pass data to the view and return it
   return view('customer.cart.cart', ['productDetails' => $productDetails]);
}

    

    public function addToCart(Request $request)
    {
        // Logic to add a product to the user's shopping cart
        $searchTerm = session('searchTerm');
          // Assuming you have the user's ID and product's ID available
          $cart = Cart::create([
            'customer_id' => auth()->id(), // Assuming the customer is the authenticated user
            'chef_id' => $request->input('chef_id'), // Adjust this based on your data
            'product_id' => $request->input('product_id'),
            // Add other fields as needed
        ]);

        $products = Product::all(); 
        return view('customer.products.index', ['products' => $products,'searchTerm' => $searchTerm]);
    }

    public function removeFromCart($id)
    {
                // Delete a specific product.
    $product = Cart::findOrFail($id);

    // Perform the deletion
    $product->delete();

    // Redirect to the index page or any other page after deletion
    return redirect()->route('customer.viewMyCartProduct')->with('success', 'Product deleted successfully');
    }

    public function clearCart($userId)
    {
        // Logic to clear all items from the user's shopping cart
    }

    public function myCart()
    {
        $userId = Auth::id();

        // Perform a join between carts and products tables
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('users', 'carts.chef_id', '=', 'users.id') // Join with the users table for chief details
            ->select('products.*', 'carts.*','users.name as chef_name') // Select all columns from both tables            
            ->where('carts.customer_id', '=', $userId)
            ->get();
    
        // Calculate the sum of product prices
        $totalPrice = $cartItems->sum('food_price');
    
        return view('customer.cart.myCart', compact('cartItems', 'totalPrice'));
    
        
    }

    // Additional methods for updating quantities, applying discounts, etc.
}
