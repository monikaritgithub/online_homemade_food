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
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    @vite(['resources/css/cart.css', 'resources/js/cart.js'])
    <style>
        .order-wrapper {
            display: flex;
            justify-content: space-between;
        }

        .left-main-wrapper {
            flex: 1;
            max-height: calc(100vh - 20px);
            overflow-y: auto;
            margin-right: 10px;
        }

        .order-summary {
            flex: 1;
            margin-left: 10px;
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
                                        <form id="update-form-{{ $cartItem->id }}" action="{{ route('cart.update.quantity', $cartItem->id) }}" method="post">
    @csrf
    @method('PUT')
    <button type="button" class="button product-quantity-input-decrease" onclick="changeQuantity('{{ $cartItem->id }}', -1)">-</button>
    <input type="number" id="quantity-{{ $cartItem->id }}" class="input product-quantity-input-number" name="quantity" min="1" max="5" value="{{ $cartItem->quantity }}" required oninput="changeQuantity('{{ $cartItem->id }}', 0); startTimer('{{ $cartItem->id }}')">
    <button type="button" class="button product-quantity-input-increase" onclick="changeQuantity('{{ $cartItem->id }}', 1)">+</button>
</form>


                                            <form action="{{ route('customer.deleteMyCartProduct', $cartItem->id) }}" method="post">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="button button-secondary red" aria-label="remove">remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-detail-item-price">Rs. {{ $cartItem->food_price*$cartItem->quantity }}</div>
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
                                <div class="order-summary-item">{{ $totalPrice }}</div>
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
                                </div>
                            </div>
                            <div class="order-summary-item-wrapper">
                                <div class="order-summary-item">Shipping</div>
                                <div class="order-summary-item text-primary">Free</div>
                            </div>
                            <div class="order-summary-item-wrapper">
                                <div class="order-summary-item"></div>
                            </div>
                        </div>
                        <div class="order-summary-total">
                            <div class="order-summary-total-title">Total</div>
                            <div class="order-summary-total-price">{{ $discountedPrice }}</div>
                        </div>
                        <div class="order-summary-delivery"><span class="order-summary-delivery-bold"></span></div>
                        <button id="payment-button" class="text-center khalti-button">
                            <img src="{{ url('icons/khalti.png') }}" alt="Khalti">
                        </button>
                        <form id="order-form" method="post" action="{{ route('orders.createCart') }}">
                            @csrf

                            @foreach($cartItems as $item)
                                <input type="hidden" name="cart[{{ $item->id }}][customer_id]" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="cart[{{ $item->id }}][chef_id]" value="{{ $item->chef_id }}">
                                <input type="hidden" name="cart[{{ $item->id }}][product_id]" value="{{ $item->product_id }}">
                                <input type="hidden" name="cart[{{ $item->id }}][payment_method]" value="Cash">
                                <input type="hidden" name="cart[{{ $item->id }}][payment_status]" value="pending">
                                <input type="hidden" name="cart[{{ $item->id }}][price]" value="{{ $item->food_price }}">
                                <input type="hidden" name="cart[{{ $item->id }}][quantity]" id="quantity_{{ $item->id }}" value="{{ $item->quantity }}">
                            @endforeach

                            <button type="submit" class="button button-primary">Order with Cash</button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
<script src="js/main.js"></script>

<!-- for payment -->
<script>

    var timers = {}; // Object to store timers for each quantity input field

    function startTimer(cartItemId) {
        // Clear the previous timer for the specific cart item if exists
        clearTimeout(timers[cartItemId]);
        
        // Start a new timer for 3 seconds for the specific cart item
        timers[cartItemId] = setTimeout(function() {
            // If the user hasn't changed the value in 3 seconds, submit the form for the specific cart item
            document.getElementById('update-form-' + cartItemId).submit();
        }, 3000);
    }

    function changeQuantity(cartItemId, increment) {
        var quantityInput = document.querySelector('#quantity-' + cartItemId);
        var currentValue = parseInt(quantityInput.value);
        var newValue = currentValue + increment;
        
        // Ensure the new value is within the min and max limits
        if (newValue >= parseInt(quantityInput.min) && newValue <= parseInt(quantityInput.max)) {
            quantityInput.value = newValue;
            
            // Start the timer when the input value changes for the specific cart item
            startTimer(cartItemId);
        }
    }
</script>



<!-- for payment -->
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
                                            "publicKey": "test_public_key_168a8ceb8f384e6ab62740da9f90d8c0",
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
