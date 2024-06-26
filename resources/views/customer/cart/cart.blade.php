@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>

        <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js">
        </script>
        @vite(['resources/css/viewproducts.css'])

    </head>

    <body>

        <section class="h-100 h-custom" style="background-color: #eee; container">
            <div class=" py-5 h-100 container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                        @if(session('success_message'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_message') }}
        
    </div>
    <script>
        // Automatically close the success message after 3 seconds
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 5000);
    </script>
@endif
                            <div class="card-body p-4">

                                <div class="row">

                                    <div class="">
                                        <section style="">



                                    <!-- product detail -->
                                    <h2>Product Details</h2>
   






                                    <!-- extra -->
                                    <div class="top-header__right">
                                        <button class="top-header__btn-cart" type="button" aria-controls="cart-section"
                                            aria-expanded="false">
                                            <span class="sr-only">Button cart</span>
                                            <span class="icon icon-cart" aria-hidden="true"></span>
                                            <span class="items-quantity">
                                                <span class="value">0</span><span class="sr-only">items</span>
                                            </span>
                                        </button>
                                        <button class="user-container" type="button" aria-label="User section">
                                            <img src="images/image-avatar.png" alt="" class="user-container__img"
                                                role="presentation">
                                        </button>
                                    </div>


                                    </header>

                                    <main>
                                        <article class="product">
                                            <section class="product__slider default-container"
                                                aria-label="Product preview">
                                                <button type="button" class="product__slider___btn-close-lightbox">
                                                    <span class="sr-only">Close lightbox</span>
                                                    <span class="icon icon-close" aria-hidden="true"></span>
                                                </button>
                                                <div class="image-box" aria-label="Product preview" role="region">
                                                    <button type="button" class="btn-previousImage">
                                                        <span class="sr-only">Previous Image</span>
                                                        <span class="icon icon-previous" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="btn-nextImage">
                                                        <span class="sr-only">Next Image</span>
                                                        <span class="icon icon-next" aria-hidden="true"></span>
                                                    </button>
                                                    <img src="{{ url('products/'.$productDetails->food_image) }}"
                                                        alt="Brown and white sneaker" class="image-box__src"
                                                        data-product-id="item-cart-1" tabindex="0"
                                                        aria-controls="lightbox" aria-expanded="false">

                                                        <div class="input-group quantity-control mt-5">
    <div class="input-group-prepend">
        <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">-</button>
    </div>
    <input type="number" class="form-control input-quantity text-center" name="quantity" min="1" max="5" value="1" readonly>
    <div class="input-group-append">
        <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">+</button>
    </div>
</div>

                                                </div>

                                            </section>
                                            <section class="product__content default-container"
                                                aria-label="Product content">
                                                <header>
                                                    
                                                <a href="{{ url('/users/' . $productDetails->chief_id) }}">
    <h2 class="company-name" tabindex="0">{{ $productDetails->name }}</h2>
</a>

                                                    <p class="product__name" tabindex="0">Autumn Limited Edition
                                                        Sneakers</p>
                                                    <h3 class="product__title" tabindex="0">
                                                        {{ $productDetails->food_name }}</h3>
                                                </header>
                                                <p class="product__description" tabindex="0">
                                                    {{ $productDetails->food_descriptions }}
                                                </p>
                                                <p class="product__description" tabindex="0">
                                                Category: {{ $productDetails->category_tag }}
                                                </p>
                                                <div class="product__price">
                                                    <div class="discount-price">
                                                        <p class="discount-price__value" tabindex="0">
                                                            Rs. {{ $productDetails->food_price }}
                                                            <span class="sr-only">dollars</span>
                                                        </p>
                                                        <p class="discount-price__discount" tabindex="0">30%</p>
                                                    </div>
                                                    <div class="full-price">
                                                        <p tabindex="0">
                                                            Rs. {{ $productDetails->food_price+100 }}
                                                            <span class="sr-only">dollars</span>
                                                        </p>
                                                    </div>
                                                    @if($productDetails->is_available == 0)
                                                    <div class="alert alert-danger" role="alert">
                                                        product is out of stock add to cart we will notify you later
                                                        when it availllable
                                                    </div>
                                                    <div class="container d-flex justify-content-center">
    <div class="text-center">
        <button type="button" class="cart-form__add-btn mx-auto" style="width: 100%;">
            <span class="icon icon-cart m-auto text-center" aria-hidden="true"></span>
            Add to cart
        </button>
    </div>
</div>


                                                  </div>
                                                    @else
                                                    <div class="cart-form">
                                                        <button id="payment-button" class="text-center khalti-button">
                                                            <img src="{{ url('icons/khalti.png') }}" alt="Khalti">
                                                        </button>

                                                        <form id="order-form" method="post"
                                                            action="{{ route('orders.create') }}">
                                                            @csrf
                                                            @if(Auth::check())
                                                            <input type="hidden" name="customer_id"
                                                                value="{{ Auth::user()->id }}">
                                                            @endif
                                                            <input type="hidden" name="chef_id"
                                                                value="{{ $productDetails->chief_id }}">
                                                            <input type="hidden" name="food_id"
                                                                value="{{ $productDetails->product_id }}">
                                                            <input type="hidden" name="payment_method" value="Cash">
                                                            <input type="hidden" name="payment_status" value="pending">
                                                            <input type="hidden" name="price"
                                                                value="{{ $productDetails->food_price }}">
                                                                <input type="hidden" name="quantity" id="quantity" value="1">
                                                                <input type="hidden" name="txn_id" id="txn_id" value="">
                                                            <!-- Add other hidden fields as needed -->

                                                            @if(Auth::check())
                                                            <button type="submit" id="" class="payment-button">Order
                                                                with
                                                                Cash</button>
                                                            @else
                                                            <button type="button" id="login" class="payment-button"
                                                                onclick="redirectToLogin()">Order with
                                                                Cash</button>
                                                            @endif
                                                        </form>

                                                    </div>

                                                    @endif
                                                </div>


                                            </section>
                                        </article>
                                    </main>

                                    <div class="lightbox" id="lightbox" role="dialog"></div>







                                    <!-- Place this where you need payment button -->


                                    <!-- Place this where you need payment button -->
                                    <!-- Paste this code anywhere in you body tag -->
                                    <script>
                                        var config = {
                                            // replace the publicKey with yours
                                            "publicKey": "test_public_key_168a8ceb8f384e6ab62740da9f90d8c0",
                                            "productIdentity": "{{ $productDetails->product_id }}",
                                            "productName": "{{ $productDetails->food_name }}",
                                            "productUrl": "http://127.0.0.1:8000/customer/cart/{{ $productDetails->product_id }}",
                                            "paymentPreference": [
                                                "KHALTI",
                                                "EBANKING",
                                                "MOBILE_BANKING",
                                                "CONNECT_IPS",
                                                "SCT",
                                            ],
                                            "eventHandler": {
                    onSuccess (payload) {
                        // hit merchant api for initiating verfication
                        $.ajax({
    type : 'POST',
    url : "{{ route('khalti.verifyPayment') }}",
    data: {
        token : payload.token,
        amount : payload.amount,
        "_token" : "{{ csrf_token() }}"
    },
    success : function(res){
        // Parse JSON response
        var jsonResponse = JSON.parse(res);

        // Send parsed response to storePayment endpoint
        $.ajax({
            type : "POST",
            url : "{{ route('khalti.storePayment') }}",
            data : {
                response : jsonResponse, // Send parsed response
                "_token" : "{{ csrf_token() }}"
            },
            success: function(res){
                $('#order-form input[name="payment_method"]').val("Khalti");
                                $('#order-form input[name="payment_status"]').val("paid");
                                $('#order-form input[name="txn_id"]').val(jsonResponse['idx']);

                                // Submit the form
                                $('#order-form').submit();
                                console.log(jsonResponse['idx']);
                console.log('transaction successfull');
               
            }
        });
        console.log(jsonResponse);
    }
});

                        console.log(payload);
                    },
                    onError (error) {
                        console.log(error);
                    },
                    onClose () {
                        console.log('widget is closing');
                    }
                }
                                        };

                                        var checkout = new KhaltiCheckout(config);
                                        var btn = document.getElementById("payment-button");
                                        btn.onclick = function () {
                                            // minimum transaction amount must be 10, i.e 1000 in paisa.
                                            var amountInRupies = {{ $productDetails-> food_price
                                        }} * 100; // Assuming food_price is in rupees
                                        checkout.show({ amount: amountInRupies });
        }

                                        // Simulate a click on page load
                                        document.addEventListener('', function () {
                                            var paymentButton = document.getElementById('payment-button');
                                            paymentButton.click();
                                            paymentButton.style.display = 'none';
                                        });


                                        function redirectToLogin() {
                                            window.location.href = "{{ route('login') }}";
                                        }

                                        
                                        function changeQuantity(increment) {
        var quantityInput = document.querySelector('.input-quantity');
        var currentValue = parseInt(quantityInput.value);
        var newValue = currentValue + increment;
        
        // Ensure the new value is within the min and max limits
        if (newValue >= parseInt(quantityInput.min) && newValue <= parseInt(quantityInput.max)) {
            quantityInput.value = newValue;
            document.getElementById('quantity').value = newValue; // Update hidden input value
        }
    }
                                    </script>
                                    <!-- Paste this code anywhere in you body tag -->
                                    <style>
                                        .payment-button,
                                        .payment-button:hover {
                                            /* Frame 10 */


                                            padding: 8px;
                                            gap: 8px;

                                            position: absolute;
                                            width: 232px;
                                            height: 72px;



                                            background: #F0484E;
                                            border-radius: 5px;

                                        }

                                        .khalti-button {
                                            /* image 16 */

                                            position: relative;
                                            width: 167px;
                                            height: 74.59px;
                                            margin-right: 10px;
                                            border-radius: 5px;
                                            border: none;

                                        }
                                    </style>


        </section>
        <script>
    // Automatically close the success message after 3 seconds
    $(document).ready(function(){
        setTimeout(function() {
            $(".alert").fadeOut();
        }, 3000);
    });
</script>


<section class=" py-5 my-5 py-xl-8">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-6 text-secondary mb-2 text-uppercase text-center">Happy Customers Reviews</h2>
                    
                    <hr class="w-50 mx-auto mb-0 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container overflow-hidden">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($reviewGroups as $index => $group)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row align-items-stretch"> <!-- Ensure all cards have the same height -->
                                @foreach ($group as $review)
                                    <div class="col-12 col-md-4">
                                        <div class="card h-100 border-0 border-bottom border-primary shadow-sm rounded">
                                            <div class="card-body p-4 p-xxl-5">
                                                <figure>
                                                    <img class="img-fluid rounded-circle mb-4 border border-5" loading="lazy" src="{{ asset('storage/'.$review->profile_photo_url) }}" alt="{{ $review->user_name }}" width="100">
                                                    <figcaption>
                                                        <div class="reviews">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <span class="fa fa-star checked"></span>
                                                                @else
                                                                    <span class="fa fa-star"></span>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <blockquote class="bsb-blockquote-icon mb-4">{{ $review->review }}</blockquote>
                                                        <h4 class="mb-2">{{ $review->user_name }}</h4>
                                                        <h5 class="fs-6 text-secondary mb-0">{{ $review->location }}</h5>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <style>
            .fa {
                font-size: 20px;
                color: gray; /* Gold color */
                margin-right: 5px;
            }

            .checked {
                color: #f8b700; /* Lighter gold color for checked stars */
            }

            .card {
                transition: transform 0.3s;
            }

            .card:hover {
                transform: translateY(-5px); /* Add some hover effect */
            }
        </style>
    </section>

    </body>

</html>
@endsection



