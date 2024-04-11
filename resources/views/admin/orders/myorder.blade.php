@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Orders</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th>Delivery Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->food_name }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>
                        @if ($order->payment_status == 'pending')
                            <span class="text-danger">Unpaid</span>
                        @elseif ($order->payment_status == 'paid')
                            Paid
                        @else
                            Unknown Status
                        @endif
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                    @if ($order->payment_status == 'pending')
    <span class="text-danger">Payment Unpaid</span>
@else
    @if ($order->status == 100)
        <span class="text-success">Order Complete</span>
    @else
        <form id="updateForm{{ $order->id }}" action="{{ route('update.order.status', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="button" class="btn btn-link" onclick="updateOrderStatus({{ $order->id }})" value="100"><i class="fas fa-check text-success"></i></button>
        </form>
    @endif
@endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function updateOrderStatus(orderId) {
        // Submit the form
        document.getElementById('updateForm' + orderId).submit();

        // Show alert message for 3 seconds
        setTimeout(function() {
            alert('Order status updated successfully');
        }, 3000);
    }
</script>

@endsection
