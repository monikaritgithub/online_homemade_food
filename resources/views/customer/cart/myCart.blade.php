@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')

@section('content')
    <div class="container">
        @if($cartItems->isEmpty())
            <h1>No items in your cart</h1>
            <p>Continue shopping <a href="{{ route('customer.viewProductByLocation') }}">here</a>.</p>
        @else
            <h1>My Cart</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Chef</th>
                        <th>Price(Rs)</th>
                        <th></th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->food_name }}</td>
                            <td>{{ $cartItem->chef_name }}</td>
                            <td>{{ $cartItem->food_price }}</td>
                            <td>
                                <form action="{{ route('customer.deleteMyCartProduct', $cartItem->id) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"><strong>Total Price:</strong></td>
                        <td>{{ $totalPrice }}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
@endsection
