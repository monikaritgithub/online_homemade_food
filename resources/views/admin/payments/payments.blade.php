@extends('layouts.adminDashboard')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Payments</h1>

    <!-- Cash Payments -->
    <div class="card mb-4">
        <div class="card-header">
            Cash Payments
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cashPayments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->food_name }}</td>
                            <td> <a href="{{ url('/users/' . $payment->customer_id) }}">{{ $payment->customer_name }}</a></td>
                            <td>{{ $payment->price }}</td>
                            <td>{{ $payment->payment_status }}</td>
                            <td>
                                <form action="{{ route('update.payment.status', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="payment_status" onchange="this.form.submit()">
                                        <option value="pending" {{ $payment->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $payment->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Khalti Payments -->
    <div class="card">
        <div class="card-header">
            Khalti Payments
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Txn Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($khaltiPayments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->food_name }}</td>
                            <td> <a href="{{ url('/users/' . $payment->customer_id) }}">{{ $payment->customer_name }}</a></td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>
                                {{ $payment->transaction_id }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
