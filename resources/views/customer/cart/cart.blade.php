@extends('layouts.customerDashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>

        <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js">
        </script>

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
                                        <section style="background-color: #eee;">
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
                                            <h2>Chief Details</h2>

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
                                                            @endif

                                                            <!-- <h5 class="my-3">{{ $productDetails->name }}</h5> -->
                                                            <!-- <p class="text-muted mb-1">Full Stack Developer</p> -->
                                                            <!-- <p class="text-muted mb-4">{{ $productDetails->location }}</p> -->

                                                        </div>
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
                                                            </div>
                                                            <!-- <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $productDetails->contactno }}</p>
              </div>
            </div> -->
                                                            <hr>
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
                                    </div>




                                    <!-- product detail -->
                                    <h2>Product Details</h2>
                                    <div class="">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3 flex">
                                                        <p class="mb-0">Product Name</p>

                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $productDetails->food_name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Image</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <img src="{{ url('products/'.$productDetails->food_image) }}"
                                                            class="card-img-top" alt="Product 1"
                                                            style="height: 200px; width: 300px;">
                                                    </div>
                                                </div>
                                                <!-- <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $productDetails->contactno }}</p>
              </div>
            </div> -->
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Description</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            {{ $productDetails->food_descriptions }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Category</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $productDetails->category_tag }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Status</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            @if($productDetails->is_available == 1)
                                                            Available
                                                            @else
                                                            Not Available
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Price</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $productDetails->food_price }}</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>





                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Payment Method</p>
                                        </div>
                                        <div class="col-sm-9 d-flex">
                                            <button id="payment-button" class="text-center khalti-button">
                                                <img src="{{ url('icons/khalti.png') }}" alt="Khalti">
                                            </button>

                                            <form id="order-form" method="post" action="{{ route('orders.create') }}">
                                                @csrf
                                                <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="chef_id"
                                                    value="{{ $productDetails->chief_id }}">
                                                <input type="hidden" name="product_id"
                                                    value="{{ $productDetails->product_id }}">
                                                <input type="hidden" name="payment_method" value="Cash">
                                                <input type="hidden" name="payment_status" value="0">
                                                <input type="hidden" name="price"
                                                    value="{{ $productDetails->food_price }}">
                                                <!-- Add other hidden fields as needed -->
                                                <button type="submit" id="" class="payment-button ">Order
                                                    with Cash</button>
                                            </form>
                                        </div>
                                    </div>



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
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
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
            var amountInRupies = {{$productDetails->food_price }} * 100; // Assuming food_price is in rupees
        checkout.show({ amount: amountInRupies });
        }

            // Simulate a click on page load
    document.addEventListener('', function() {
        var paymentButton = document.getElementById('payment-button');
        paymentButton.click();
        paymentButton.style.display = 'none';
    });
                                    </script>
                                    <!-- Paste this code anywhere in you body tag -->
                                    <style>
                                        .payment-button {
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