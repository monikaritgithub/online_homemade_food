<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Rules\ValidChiefId;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;





class ProductController extends Controller
{
    public function index()
    {
        // Retrieve a list of products and display them.
        $user = auth()->user();
        $products = Product::where('chief_id', $user->id)->get();
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        // Display a form for creating a new product.
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // Store a new product based on the submitted form data.
        $validatedData = $request->validate([
            // Define validation rules here

            'food_name' => 'required',
       
        'food_descriptions' => 'required',
        'ingredients' => 'nullable',
        'is_available' => 'required|in:true,false',
        'category_tag' => 'nullable',
        'quantity_available' => 'nullable|integer',
        'food_price' => 'required|numeric',
      
        ]);

         // Convert the string value to a boolean
    $validatedData['is_available'] = filter_var($request->input('is_available'), FILTER_VALIDATE_BOOLEAN);

        

    if($request->file('food_image')){
        $file= $request->file('food_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('products'), $filename);
        $validatedData['food_image']= $filename;
    }


            // Set the chief_id to the currently authenticated user's ID
    $validatedData['chief_id'] = Auth::id();

        Product::create($validatedData);

        return view('admin.products.create');    }

    public function show($id)
    {
        // Display the details of a specific product.
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        // Display a form for editing a product.
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Update a specific product based on the submitted form data.
        $validatedData = $request->validate([
            // Define validation rules here

            'food_name' => 'required',
       
        'food_descriptions' => 'required',
        'ingredients' => 'nullable',
        'is_available' => 'required|in:true,false',
        'category_tag' => 'nullable',
        'quantity_available' => 'nullable|integer',
        'food_price' => 'required|numeric',
      
        ]);

         // Convert the string value to a boolean
    $validatedData['is_available'] = filter_var($request->input('is_available'), FILTER_VALIDATE_BOOLEAN);

        

    if($request->file('food_image')){
        $file= $request->file('food_image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('products'), $filename);
        $validatedData['food_image']= $filename;
    }


            // Set the chief_id to the currently authenticated user's ID
    $validatedData['chief_id'] = Auth::id();

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('admin.viewProduct',$id)->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        // Delete a specific product.
    $product = Product::findOrFail($id);

    // Perform the deletion
    $product->delete();

    // Redirect to the index page or any other page after deletion
    return redirect()->route('admin.viewProduct')->with('success', 'Product deleted successfully');
    }


    protected $table = 'products';
        // Define the relationship with the User model
        public function chief()
        {
            return $this->belongsTo(User::class, 'id');
        }

    public function productShowByLocation()
    {
          // Retrieve the currently logged-in user
        $user = Auth::user();
        $searchTerm = $user->location;

        // Retrieve products with the chief's location matching the user's location
        $products = DB::table('products')
            ->join('users', 'products.chief_id', '=', 'users.id')
            ->where('users.location', 'LIKE', '%' . $user->location . '%')
            ->select('products.*','users.name as chef_name') // adjust this based on your actual column names
            ->get();
 
            return view('customer.products.index', ['products' => $products, 'searchTerm' => $searchTerm]);

    }

    public function allProductShow()
    {
        $searchTerm = 'All Locations';
        $products = Product::join('users', 'products.chief_id', '=', 'users.id')
        ->select('products.*', 'users.name as chef_name')
        ->get();
            return view('customer.products.index', ['products' => $products,'searchTerm' => $searchTerm]);
    }

    public function startProductShow()
    {
        $searchTerm = 'All Locations';
        $products = Product::join('users', 'products.chief_id', '=', 'users.id')
        ->select('products.*', 'users.name as chef_name')
        ->get();
            return view('welcome', ['products' => $products,'searchTerm' => $searchTerm]);
    }

    public function searchProducts(Request $request)
{
    $searchTerm = $request->input('search');
    session(['searchTerm' => $searchTerm]);

    // Assuming you have a relationship between User and Product models
    $products = Product::join('users', 'products.chief_id', '=', 'users.id')
    ->where('food_descriptions', 'LIKE', '%' . $searchTerm . '%')
    ->orWhere('food_name', 'LIKE', '%' . $searchTerm . '%')
    ->orWhere('users.name', 'LIKE', '%' . $searchTerm . '%') // assuming chef_name is stored in the name column of users table
    ->orWhere('users.location', 'LIKE', '%' . $searchTerm . '%')        
    ->select('products.*','users.name as chef_name')
        ->get();

        return view('customer.products.index', compact('products', 'searchTerm'));
    }

    public function searchProductsWithoutAuth(Request $request)
    {
        $searchTerm = $request->input('search');
        session(['searchTerm' => $searchTerm]);
    
        // Assuming you have a relationship between User and Product models
        $products = Product::join('users', 'products.chief_id', '=', 'users.id')
        ->where('food_descriptions', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('food_name', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('users.name', 'LIKE', '%' . $searchTerm . '%') // assuming chef_name is stored in the name column of users table
        ->orWhere('users.location', 'LIKE', '%' . $searchTerm . '%')        
        ->select('products.*','users.name as chef_name')
            ->get();
    
            return view('welcome', compact('products', 'searchTerm'));
        }

    public function viewProductDetailAdmin($productId)
    {
       // Retrieve product details with the corresponding chief information using join
       $productDetails = DB::table('products')
       ->join('orders', 'products.id', '=', 'orders.product_id')
       ->join('users','orders.customer_id', '=', 'users.id')
       ->select(
           'products.id as product_id',
           'products.food_name',
           'products.food_price',
           'products.food_image',
           'products.food_descriptions',
           'products.category_tag',
           'products.is_available',
           'users.id as user_id',
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
   return view('admin.products.productDetails', ['productDetails' => $productDetails]);
    }


}