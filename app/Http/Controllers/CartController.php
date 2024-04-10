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
            'quantity' => $request->input('quantity'),
            // Add other fields as needed
        ]);
        $product_name = Product::where('id', $request->input('product_id'))->first()->food_name;
        session()->flash('success_message', 'The product '.$product_name.' has been added to your cart successfully!');
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

    public function clearCart()
{
    $userId = Auth::id();
    try {
        // Delete cart items associated with the user ID
        Cart::where('customer_id', $userId)->delete();
        
        // Return true to indicate success
        return redirect('/customer/orders');
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        \Log::error('Error clearing cart: ' . $e->getMessage());
        
        // Return false to indicate failure
        return false;
    }
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
    
            // Calculate the total price taking into account the quantity of each item
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item->food_price * $item->quantity;
    }
        $totalCartItems = $cartItems->count();
    
        // return view('customer.cart.myCart', compact('cartItems', 'totalPrice'));
        return view('customer.cart.cartDetails', compact('cartItems', 'totalPrice','totalCartItems'));
    
        
    }

    // Additional methods for updating quantities, applying discounts, etc.

    public function updateCartItemQuantity(Request $request, $cartItemId)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1|max:5',
        ]);

        // Find the cart item
        $cartItem = Cart::findOrFail($cartItemId);

        // Update the quantity
        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        // Redirect back to the previous page
        return back()->with('success', 'Cart item quantity updated successfully.');
    }
}
