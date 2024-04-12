@extends('layouts.customerDashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Review for {{ $product->name }}</div>

                    <div class="card-body">
                        <form action="{{ route('customer.reviews.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="review">Review:</label>
                                <textarea name="review" id="review" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
