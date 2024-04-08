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
                            <h1 class="order-header-title">Cart</h1><span class="order-header-subtitle">{{$totalCartItems}}</span>
                        </header>
                        @foreach($cartItems as $cartItem)
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
                                    <div class="order-summary-item">0%</div> <!-- Calculated discount -->
                                </div>
                                <div class="order-summary-item-wrapper">
                                    <div class="order-summary-item">Shipping</div>
                                    <div class="order-summary-item text-primary">Free</div>
                                </div>
                                <div class="order-summary-item-wrapper">
                                    <div class="order-summary-item">Coupon Applied</div>
                                    <div class="order-summary-item"></div> <!-- Coupon value -->
                                </div>
                            </div>
                            <div class="order-summary-total">
                                <div class="order-summary-total-title">Total</div>
                                <div class="order-summary-total-price">{{ $totalPrice }}</div> <!-- Calculated final total -->
                            </div>
                            <div class="order-summary-delivery"> <span class="order-summary-delivery-bold"></span></div>
                            <!-- <div class="order-summary-coupon-input">
                                <svg class="icon icon-tag">
                                    <use xlink:href="#icon-tag"></use>
                                </svg>
                                <input type="text" name="coupon" id="coupon" placeholder="Coupon Code" class="input input-coupon">
                            </div> -->
                            <a title="proceed to checkout" href="" class="button button-primary">proceed to checkout</a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>
    <script src="js/main.js"></script>
</body>

</html>
@endsection
