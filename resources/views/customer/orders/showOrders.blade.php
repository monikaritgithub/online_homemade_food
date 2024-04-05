@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')
@section('content')
<?php

// Generate a random receipt voucher
$receipt_voucher = strtoupper(substr(uniqid(), 0, 6)); // Generates a unique ID and takes the first 6 characters

// Generate a random invoice number
$invoice_number = strtoupper(substr(uniqid(), 6, 6)); // Generates a unique ID and takes the characters from position 6 to 12

// Generate current date for invoice date
$invoice_date = date('Y-m-d');

// Calculate total amount
$total_amount = 0;
foreach ($orders as $order) {
    $total_amount += $order['price'];
}

// Other random values or calculations
$discount = 0; // Random discount between 5 and 20
$gst_amount = $total_amount * 0.18; // Assuming 18% GST
$delivery_charges = 0; // Assuming free delivery

// Calculate total paid
$total_paid = $total_amount - $discount + $gst_amount;

$user_name = Auth::user()->name;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Order</title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css"
  rel="stylesheet"
/>
</head>
<body>
<section class="h-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Thank you for your order, <span style="color: #a8729a;">{{ $user_name }}</span>!</h5>
          </div>
          <div class="card-body p-4">
            @foreach ($orders as $order)
            <a href="{{ route('customer.viewCartProduct', $order['food_id']) }}" class="view-product w-100">            <div class="card shadow-0 border mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <img src="{{ $order['food_image'] ? url('products/'.$order['food_image']) : 'placeholder.jpg' }}" class="img-fluid" alt="Food Image">
                  </div>
                  <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0">{{ $order['food_name'] }}</p>
                  </div>
                  <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"> {{ $order['payment_method'] }}</p>
                  </div>
                  <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Qty: 1</p>
                  </div>
                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                <div class="row d-flex align-items-center">
                  <div class="col-md-6">
                    <p class="text-muted mb-0 small">Track Order</p>
                    <div class="progress" style="height: 6px; border-radius: 16px;">
                      <div class="progress-bar" role="progressbar"
                        style="width: 100%; border-radius: 16px; background-color: #a8729a;" aria-valuenow="100%"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                      <p class="text-muted mb-0 small">Out for delivery</p>
                      <p class="text-muted mb-0 small">Delivered</p>
                    </div>
                  </div>
                  <div class="col-md-6 text-end">
                    <p class="text-muted mb-0 small">Price: Rs {{ number_format($order['price'], 2) }}</p>
                  </div>
                </div>
              </div>
            </div>
            </a>
            @endforeach

            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Order Details</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> Rs {{ number_format($total_amount, 2) }}</p>
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="text-muted mb-0">Invoice Number: {{ $invoice_number }}</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> Rs {{ number_format($discount, 2) }}</p>
            </div>

            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0">Invoice Date: {{ $invoice_date }}</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> {{ number_format($gst_amount, 2) }}</p>
            </div>

            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0">Receipt Voucher: {{ $receipt_voucher }}</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> {{ $delivery_charges }}</p>
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5"
            style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
              paid: <span class="h2 mb-0 ms-2">Rs {{ number_format($total_paid, 2) }}</span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
@endsection