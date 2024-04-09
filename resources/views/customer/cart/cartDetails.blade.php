@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Product & Checkout E-Commerce Template</title>
    <meta name="description" content="Product & Checkout E-Commerce Template">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js">
        </script>
    @vite(['resources/css/cart.css', 'resources/js/cart.js'])
    <style>
        .order-wrapper {
            display: flex;
            justify-content: space-between;
        }

        .left-main-wrapper {
            flex: 1;
            max-height: calc(100vh - 20px); /* Adjust the value as per your layout */
            overflow-y: auto;
            margin-right: 10px; /* Adjust spacing between sections */
        }

        .order-summary {
            flex: 1;
            margin-left: 10px; /* Adjust spacing between sections */
        }
    </style>
</head>
<body>
    <main class="main">
        <section class="order">
            <div class="container">
                <div class="order-wrapper checkout-wrapper">
                    <div class="left-main-wrapper">
                        <header class="order-header">
                            <h1 class="order-header-title">Cart</h1>
                            <span class="order-header-subtitle">{{$totalCartItems}}</span>
                        </header>
                        @foreach($cartItems as $index => $cartItem)
                            <div class="order-item-wrapper">
                                <div class="order-detail-item-wrapper">
                                    <div class="order-detail-item">
                                        <figure class="order-detail-item-photo">
                                            <picture><img src="{{ url('products/'.$cartItem->food_image) }}" alt="Product Photo"></picture>
                                        </figure>
                                        <div class="order-detail-item-content">
                                            <div class="order-detail-item-content-title">{{ $cartItem->food_name }}</div>
                                            <div class="order-detail-item-content-color">
                                                <div class="order-detail-item-content-color-light">Chef Name</div>
                                                <div class="order-detail-item-content-color-dark">{{ $cartItem->chef_name }}</div>
                                            </div>
                                            <div class="order-detail-item-content-buttons">
                                                <label class="product-quantity-input">
                                                    <button aria-label="decrease quantity" type="button" class="button product-quantity-input-decrease"><svg class="icon icon-minus">
                                                            <use xlink:href="#icon-minus"></use>
                                                        </svg></button>
                                                    <input type="number" class="input product-quantity-input-number" name="product-quantity" min="1" max="5" value="1" required>
                                                    <button aria-label="increase quantity" type="button" class="button product-quantity-input-increase"><svg class="icon icon-plus">
                                                            <use xlink:href="#icon-plus"></use>
                                                        </svg></button>
                                                </label>
                                                <form action="{{ route('customer.deleteMyCartProduct', $cartItem->id) }}" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="button button-secondary red" aria-label="remove">remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-detail-item-price">Rs. {{ $cartItem->food_price }}</div>
                                </div>
                                <hr><!-- Horizontal line after each product -->
                            </div>
                        @endforeach
                    </div>
                    <aside class="order-summary">
                        <div class="order-summary-wrapper">
                            <div class="order-summary-title">Order Summary</div>
                            <div class="order-summary-detail">
                                <div class="order-summary-item-wrapper">
                                    <div class="order-summary-item">Price</div>
                                    <div class="order-summary-item">{{ $totalPrice }}</div> <!-- Calculated total price -->
                                </div>
                                <div class="order-summary-item-wrapper">
                                    <div class="order-summary-item">Discount</div>
                                    <div class="order-summary-item">
        @php
            $discountPercentage = 0;
            $randomTotalPrice = rand(100, 200);
            $discountedPrice = $totalPrice;
            if ($totalPrice > $randomTotalPrice) {
                $discountPercentage = (($totalPrice - $randomTotalPrice) / $totalPrice) * 100;
                $discountedPrice = $randomTotalPrice;
            }
            echo number_format($discountPercentage, 2) . '%';
        @endphp
    </div>   <!-- Calculated discount -->
                                </div>
                                <div class="order-summary-item-wrapper">
                                    <div class="order-summary-item">Shipping</div>
                                    <div class="order-summary-item text-primary">Free</div>
                                </div>
                                <div class="order-summary-item-wrapper">
                                    <!-- <div class="order-summary-item">Coupon Applied</div> -->
                                    <div class="order-summary-item"></div> <!-- Coupon value -->
                                </div>
                            </div>
                            <div class="order-summary-total">
                                <div class="order-summary-total-title">Total</div>
                                <div class="order-summary-total-price">{{ $discountedPrice }}</div> <!-- Calculated final total -->
                            </div>
                            <div class="order-summary-delivery"> <span class="order-summary-delivery-bold"></span></div>
                            <button id="payment-button" class="text-center khalti-button">
                                                            <img src="{{ url('icons/khalti.png') }}" alt="Khalti">
                                                        </button>
                            <form id="order-form" method="post" action="{{ route('orders.createCart') }}">
    @csrf

    <!-- Loop through cart items -->
    @foreach($cartItems as $item)
        <input type="hidden" name="cart[{{ $item->id }}][customer_id]" value="{{ Auth::user()->id }}">
        <input type="hidden" name="cart[{{ $item->id }}][chef_id]" value="{{ $item->chef_id }}">
        <input type="hidden" name="cart[{{ $item->id }}][product_id]" value="{{ $item->product_id }}">
        <input type="hidden" name="cart[{{ $item->id }}][payment_method]" value="Cash">
        <input type="hidden" name="cart[{{ $item->id }}][payment_status]" value="pending">
        <input type="hidden" name="cart[{{ $item->id }}][price]" value="{{ $item->food_price }}">
        <!-- Add other hidden fields as needed -->
    @endforeach

    <button type="submit" id="payment-button" class="button button-primary">Order with Cash</button>

</form>

                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>
    <script src="js/main.js"></script>
    <script>
          var cartProducts = [];
    @foreach($cartItems as $item)
        cartProducts.push({
            id: "{{ $item->product_id }}",
            name: "{{ $item->food_name }}"
        });
    @endforeach

    var cartProductIds = cartProducts.map(product => product.id).join(', ');
    var cartProductNames = cartProducts.map(product => product.name).join(', ');

                                        var config = {
                                            // replace the publicKey with yours
                                            "publicKey": "test_public_key_7105356e1f1b4e8fb07304f6fd73cc3b",
                                            "productIdentity": cartProductIds,
                                            "productName": cartProductNames,
                                            "productUrl": "http://127.0.0.1:8000/customer/cart/",
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
                updateFormFields("Khalti", "Paid");
                        submitOrderForm();
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
                                            var amountInRupies = {{ $discountedPrice
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

                                         // Function to update form fields with payment method and status
    function updateFormFields(paymentMethod, paymentStatus) {
        @foreach($cartItems as $item)
            $('#order-form input[name="cart[{{ $item->id }}][payment_method]"]').val(paymentMethod);
            $('#order-form input[name="cart[{{ $item->id }}][payment_status]"]').val(paymentStatus);
        @endforeach
    }

    // Function to submit the order form
    function submitOrderForm() {
        $('#order-form').submit();
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
 <script>
    // Automatically close the success message after 3 seconds
    $(document).ready(function(){
        setTimeout(function() {
            $(".alert").fadeOut();
        }, 3000);
    });
</script>

</body>
</html>
@endsection
