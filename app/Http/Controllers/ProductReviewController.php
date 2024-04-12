<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::where('customer_id', Auth::id())->get();
        return view('customer.reviews.index', compact('reviews'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('customer.reviews.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $reviewData = $request->only('rating', 'review');
        $reviewData['product_id'] = $request->product_id;
        $reviewData['customer_id'] = Auth::id();

        ProductReview::create($reviewData);

        return redirect()->route('customer.reviews.show')->with('success', 'Review added successfully.');
    }
    public function show($id)
    {
        // Fetch all reviews for the given product ID
        $reviews = DB::table('product_reviews')
            ->join('products', 'product_reviews.product_id', '=', 'products.id')
            ->join('users', 'product_reviews.customer_id', '=', 'users.id')
            ->select('product_reviews.*', 'products.food_name as product_name', 'users.name as user_name','users.profile_photo_path as profile_photo_url','users.location')
            ->where('product_reviews.product_id', $id)
            ->get();
        
        if ($reviews->isEmpty()) {
            abort(404);
        }
    
        // Chunk the reviews into groups of three
        $reviewGroups = $reviews->chunk(3);
        return view('customer.reviews.show', compact('reviewGroups'));
    }
    

    public function edit($id)
    {
        $review = ProductReview::findOrFail($id);
        return view('customer.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $review = ProductReview::findOrFail($id);
        $review->update($request->all());

        return redirect()->route('customer.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = ProductReview::findOrFail($id);
        $review->delete();

        return redirect()->route('customer.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
