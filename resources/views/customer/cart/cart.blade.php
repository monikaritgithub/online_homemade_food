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
                            <div class="card-body p-4">

                                <div class="row">

                                    <div class="">
                                        <section style="">
                                            <!-- <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div> -->
                                            <!-- <h2>Chief Details</h2>

                                            <div class="row d-flex">
                                                <div class="col-lg-4 ">
                                                    <div class="card mb-4 ">
                                                        <div class="card-body text-center">
                                                            @if(is_null($productDetails->profile_photo_path))
                                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                                                alt="avatar" class="rounded-circle img-fluid"
                                                                style="width: 150px;">
                                                            @else
                                                            <img src="{{ url('storage/'.$productDetails->profile_photo_path)}}"
                                                                alt="avatar" class="rounded-circle img-fluid"
                                                                style="width: 150px;">
                                                            @endif -->

                                                            <!-- <h5 class="my-3">{{ $productDetails->name }}</h5> -->
                                                            <!-- <p class="text-muted mb-1">Full Stack Developer</p> -->
                                                            <!-- <p class="text-muted mb-4">{{ $productDetails->location }}</p> -->

                                                        <!-- </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Full Name</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        {{ $productDetails->name }}</p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Email</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        {{ $productDetails->email }}</p>
                                                                </div>
                                                            </div> -->
                                                            <!-- <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $productDetails->contactno }}</p>
              </div>
            </div> -->
                                                            <!-- <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Mobile</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        {{ $productDetails->contactno }}</p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="mb-0">Address</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">
                                                                        {{ $productDetails->location }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </section>
                                    </div> -->




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
                                                </div>

                                            </section>
                                            <section class="product__content default-container"
                                                aria-label="Product content">
                                                <header>
                                                    <h2 class="company-name" tabindex="0">{{ $productDetails->name }}
                                                    </h2>
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
                                                    <button type="button" class="cart-form__add-btn">
                                                        <span class="icon icon-cart m-auto pr-0"
                                                            aria-hidden="true"></span>
                                                        Add to cart
                                                    </button>
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
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $productDetails->product_id }}">
                                                            <input type="hidden" name="payment_method" value="Cash">
                                                            <input type="hidden" name="payment_status" value="0">
                                                            <input type="hidden" name="price"
                                                                value="{{ $productDetails->food_price }}">
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
                                            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
                                            "productIdentity": "1234567890",
                                            "productName": "Dragon",
                                            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                                            "paymentPreference": [
                                                "KHALTI",
                                                "EBANKING",
                                                "MOBILE_BANKING",
                                                "CONNECT_IPS",
                                                "SCT",
                                            ],
                                            "eventHandler": {
                                                onSuccess(payload) {
                                                    // hit merchant api for initiating verfication
                                                    console.log(payload);
                                                },
                                                onError(error) {
                                                    console.log(error);
                                                },
                                                onClose() {
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

    </body>

</html>
@endsection