@extends('layouts.welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Yummy Tummy</title>


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">


        <link rel="stylesheet" href="{{asset('css/customer/products/index.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <!-- Styles -->

    <body>
    <div class="container">
    
</div>



        <div class="mt-16">




            <!-- Product List -->

            <div class="">
                <div class="p-10">
                    <div class=" container">
                        <div class="heading">
                            <h1 class="title"><span class="part1">Our secret ingredient</span> is the
                                <h1 class="title">love of <span class="subtext">housewives turned
                                        chefs.</span></h1>
                            </h1>

                            <h1 class="subtitle">Each recipe with the warmth and expertise that only
                                home cooking can
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

                                            <span class="selling-price text-end">Rs
                                                {{ $product->food_price }}</span>
                                        </h5>
                                        <p class="product-brand">Chef: {{$product->chef_name}}</p>
                                        <div>

                                            <!-- <span class="original-price">$799</span> -->
                                        </div>
                                        <div class="mt-2 d-flex text-center">
                                            <div class="row w-100">
                                            @if (Route::has('login'))
    <div class="col">
        @auth
            <form action="{{ route('customer.carts.store') }}" method="post">
                @csrf
                @if(Auth::check() && Auth::user()->name)
                    <input type="hidden" name="customer_id" value="{{ Auth::user()->name }}">
                @endif
                <input type="hidden" name="chef_id" value='{{$product->chief_id}}'>
                <input type="hidden" name="product_id" value='{{$product->id}}'>
                <button class="add-to-cart w-100" data-product-id="1" type="submit">Add to Cart</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="add-to-cart " style="text-decoration: none;">Add to cart</a>
        @endauth
    </div>
@endif

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




        </div>
    </body>

</html>
@endsection