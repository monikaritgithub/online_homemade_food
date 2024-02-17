@extends('layouts.customerDashboard')
@section('content')
    <!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Products</title>
	    <!-- Bootstrap CSS -->
	   
	</head>
	<body>
	
	 
	    <!-- Product List -->

        <div class="py-3 py-md-5 bg-light ">
        <div class="p-10">
            <div class="row container">
                <div class="col-md-12 pl-10">
                    <h4 class="mb-4 ">Our Products Based on {{$searchTerm}}</h4>
                </div>
            @foreach($products as $product)

	            


            <div class="col-md-3 container">

                            <div class="product-card text-center">
                        <div class="product-card-img">
                        @if($product->is_available)
    <label class="stock bg-success">In Stock</label>
@else
    <label class="stock bg-danger">Out of Stock</label>
@endif

                            <img src="{{ url('products/'.$product->food_image) }}" alt="Laptop">
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">Chef: {{$product->chef_name}}</p>
                            <h5 class="product-name">
                               <a href="">
                               {{ $product->food_name }}                               </a>
                            </h5>
                            <div>
                                <span class="selling-price">Rs {{ $product->food_price }}</span>
                                <!-- <span class="original-price">$799</span> -->
                            </div>
                            <div class="mt-2 d-flex text-center">
    <div class="row w-100">
        <div class="col">
            <form action="{{ route('customer.carts.store') }}" method="post">
                @csrf
                <input type="hidden" name="customer_id" value='{{Auth::user()->name }}'>
                <input type="hidden" name="chef_id" value='{{$product->chief_id}}'>
                <input type="hidden" name="product_id" value='{{$product->id}}'>
                <button class="btn btn-primary add-to-cart w-100" data-product-id="1" type="submit">Add to Cart</button>
            </form>
        </div>
        <div class="col">
            <a href="{{ route('customer.viewCartProduct', $product->id) }}" class="btn btn-secondary add-to-cart w-100">View</a>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>

                 
                @endforeach
                </div>
        </div>
    </div>
    

	 
	    <!-- Shopping Cart -->
	    <!-- <section id="shopping-cart" class="container mt-5">
	        <h2>Shopping Cart</h2>
	        <table class="table">
	            <thead>
	                <tr>
	                    <th>Product</th>
	                    <th>Price</th>
	                    <th>Quantity</th>
	                    <th>Total</th>
	                    <th></th>
	                </tr>
	            </thead>
	            <tbody id="cart-items"> -->
	                <!-- Cart items will be dynamically added here -->
	            <!-- </tbody>
	            <tfoot>
	                <tr>
	                    <td colspan="3"></td>
	                    <td><strong>Total:</strong></td>
	                    <td id="cart-total">$0.00</td>
	                </tr>
	            </tfoot>
	        </table>
	    </section> -->
	 
	    <!-- Bootstrap & jQuery JS -->
	    


        <style>
            	/* Product Card */
.product-card{
    background-color: #fff;
    border: 1px solid #ccc;
    margin-bottom: 24px;
}
.product-card a{
    text-decoration: none;
}
.product-card .stock{
    position: absolute;
    color: #fff;
    border-radius: 4px;
    padding: 2px 12px;
    margin: 8px;
    font-size: 12px;
}
.product-card .product-card-img{
    max-height: 260px;
    overflow: hidden;
    border-bottom: 1px solid #ccc;
}
.product-card .product-card-img img{
    width: 100%;
}
.product-card .product-card-body{
    padding: 10px 10px;
}
.product-card .product-card-body .product-brand{
    font-size: 14px;
    font-weight: 400;
    margin-bottom: 4px;
    color: #937979;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.product-card .product-card-body .product-name{
    font-size: 20px;
    font-weight: 600;
    color: #000;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.product-card .product-card-body .selling-price{
    font-size: 22px;
    color: #000;
    font-weight: 600;
    margin-right: 8px;
}
.product-card .product-card-body .original-price{
    font-size: 18px;
    color: #937979;
    font-weight: 400;
    text-decoration: line-through;
}
.product-card .product-card-body .btn1{
    border: 1px solid;
    margin-right: 3px;
    border-radius: 0px;
    font-size: 12px;
    margin-top: 10px;
}
/* Product Card End */
        </style>
	</body>
	</html>
    @endsection