@extends('layouts.customerDashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Review</div>

                    <div class="card-body">
                        <form action="{{ route('customer.reviews.update', $review->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5"
                                    value="{{ $review->rating }}" required>
                            </div>

                            <div class="form-group">
                                <label for="review">Review:</label>
                                <textarea name="review" id="review" class="form-control">{{ $review->review }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
