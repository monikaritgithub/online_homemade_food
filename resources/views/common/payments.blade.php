<!-- resources/views/payments.blade.php -->

@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')

@section('content')
<div class="container">
    <h1 class="mb-4">My Payments</h1>
    <div class="row">
        @forelse ($payments as $payment)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Payment Txn Id: {{ $payment->transaction_id }}</h5>
                    <p class="card-text">Product Name: {{ $payment->food_name }}</p> <!-- Use food_name instead of product->name -->
                    <p class="card-text">Amount: {{ $payment->amount }}</p>
                    <p class="card-text">Payment Date: {{ $payment->created_at->format('M d, Y H:i:s') }}</p>
                    <p class="card-text">Paid By: {{ $payment->paid_by }}</p>
                    <p class="card-text">Status: {{ $payment->status }}</p>
                    <p class="card-text">Payment Type: {{ $payment->payment_type }}</p>
                    <!-- Add more payment details as needed -->
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <p>No payments found.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
