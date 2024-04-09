<!-- resources/views/payments.blade.php -->

@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')

@section('content')
<div class="container">
    <h1 class="mb-4">My Payments</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Payment Txn Id</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Paid By</th>
                    <th>Status</th>
                    <th>Payment Type</th>
                    <!-- Add more headers as needed -->
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->transaction_id }}</td>
                    <td>
                        @if (strpos($payment->product_id, ',') !== false)
                            @php
                                $productIds = explode(',', $payment->product_id);
                                $productNames = [];
                                foreach ($productIds as $productId) {
                                    $productName = App\Models\Product::find($productId)->food_name;
                                    $productNames[] = $productName;
                                }
                                echo implode(', ', $productNames);
                            @endphp
                        @else
                            {{ $payment->food_name }}
                        @endif
                    </td> <!-- Use food_name instead of product->name -->
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->created_at->format('M d, Y H:i:s') }}</td>
                    <td>{{ $payment->paid_by }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->payment_type }}</td>
                    <!-- Add more payment details as needed -->
                </tr>
                @empty
                <tr>
                    <td colspan="7">No payments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
