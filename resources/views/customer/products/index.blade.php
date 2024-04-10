@extends('layouts.customerDashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/customer/products/index.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    </head>

    <body>


        <!-- Product List -->

        <div class="py-3 py-md-5 bg-light ">
            <div class="p-10">
                <div class=" container">
                @if(session('success_message'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_message') }}
        
    </div>
    <script>
        // Automatically close the success message after 3 seconds
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 2000);
    </script>
@endif
                    <div class="heading">
                        <h1 class="title"><span class="part1">Our secret ingredient</span> is the
                            <h1 class="title">love of <span class="subtext">housewives turned chefs.</span></h1>
                        </h1>

                        <h1 class="subtitle">Each recipe with the warmth and expertise that only home cooking can
                            provide.</h1>
                    </div>
                    <div class=" ">
                        <h4 class="mb-4  ourProducts ">Our Products Based on {{$searchTerm}}</h4>
                    </div>
                    <div class="products">
                        @foreach($products as $product)




                        <div class="col-md-4 container">

                            <div class="product-card ">
                                <div class="product-card-img">
                                    @if($product->is_available)
                                    <label class="stock bg-success">In Stock</label>
                                    @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                    @endif

                                    <img src="{{ url('products/'.$product->food_image) }}" alt="Laptop">
                                </div>
                                <div class="product-card-body">
                                 
                                    <h5 class="product-name">
                                        <a href="">
                                            {{ $product->food_name }} </a>

                                            <span class="selling-price text-end">Rs {{ $product->food_price }}</span>
                                    </h5>
                                    <p class="product-brand">Chef: {{$product->chef_name}}</p>
                                    <div>
                                        
                                        <!-- <span class="original-price">$799</span> -->
                                    </div>
                                    <div class="mt-2 d-flex text-center">
                                        <div class="row w-100">
                                            <div class="col">
                                                <form action="{{ route('customer.carts.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="customer_id"
                                                        value='{{Auth::user()->name }}'>
                                                    <input type="hidden" name="chef_id" value='{{$product->chief_id}}'>
                                                    <input type="hidden" name="product_id" value='{{$product->id}}'>
                                                    <input type="hidden" name="quantity" value='1'>

                                                    <button class="add-to-cart w-100"
                                                        data-product-id="1" type="submit">Add to Cart</button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <a href="{{ route('customer.viewCartProduct', $product->id) }}"
                                                    class="view-product w-100">View</a>
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
        </div>

    </body>

</html>
@endsection