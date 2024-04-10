@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')
@section('content')
<?php

// Generate a random receipt voucher
$receipt_voucher = strtoupper(substr(uniqid(), 0, 6)); // Generates a unique ID and takes the first 6 characters

// Generate a random invoice number
$invoice_number = strtoupper(substr(uniqid(), 6, 6)); // Generates a unique ID and takes the characters from position 6 to 12

// Generate current date for invoice date
$invoice_date = date('Y-m-d');

// Initialize an array to store orders for each chef
$chef_orders = [];

// Group orders by chef ID
foreach ($orders as $order) {
    $chef_id = $order['chef_id'];
    $chef_name = $order['chef_name'];

    if (!isset($chef_orders[$chef_id])) {
        $chef_orders[$chef_id] = ['chef_name' => $chef_name, 'orders' => [], 'total_amount' => 0];
    }
    $chef_orders[$chef_id]['orders'][] = $order;
    $chef_orders[$chef_id]['total_amount'] += $order['price'];
}

// Other random values or calculations
$discount = 0; // Random discount between 5 and 20
$delivery_charges = 0; // Assuming free delivery
$total_paid = 0; // Total amount paid by the customer
$user_name = Auth::user()->name;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #a8729a;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            color: #fff;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            padding: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .card-footer {
            background-color: #a8729a;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            color: #fff;
            font-size: 20px;
            padding: 20px;
        }
        .view-product:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
<section class="h-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        Thank you for your order, <span>{{ $user_name }}</span>!
                    </div>
                    <div class="card-body">
                        @foreach ($chef_orders as $chef_id => $chef_data)
                            <h3 class="pt-4">Chef Name: {{ $chef_data['chef_name'] }}</h3>
                            @foreach ($chef_data['orders'] as $order)
                                <a href="{{ route('customer.viewCartProduct', $order['food_id']) }}" class="view-product">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="{{ $order['food_image'] ? url('products/'.$order['food_image']) : 'placeholder.jpg' }}" class="img-fluid" alt="Food Image">
                                                </div>
                                                <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0">{{ $order['food_name'] }}</p>
                                                </div>
                                              
                                                <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0">Payment Method: {{ $order['payment_method'] }}</p>
                                                </div>
                                                <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0">Payment Status: {{ $order['payment_status'] }}</p>
                                                </div>
                                            </div>
                                            <hr class="my-4">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-md-6">
                                                    <p class="text-muted mb-0">Track Order</p>
                                                    <div class="progress" style="height: 6px; border-radius: 16px;">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{$order['status']}}%; border-radius: 16px; background-color: #a8729a;" aria-valuenow="100%"
                                                             aria-valuemin="0" aria-valuemax="{{$order['status']}}"></div>
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-1">
                                                        <p class="text-muted mb-0">Pending</p>
                                                        <p class="text-muted mb-0">Delivered</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-end flex">
                                                    <p class="text-muted  mb-0  ">Quantity: {{ $order['quantity'] }}</p>
                                                
                                                    <p class="text-muted mb-0 ">Price: Rs {{ number_format($order['price'], 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="card-footer">
                        Total Paid: Rs {{ number_format($chef_data['total_amount'], 2) }}
                    </div>
                            <div class="mb-4"></div>
                        @endforeach
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

@endsection
