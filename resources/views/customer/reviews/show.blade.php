@extends('layouts.customerDashboard')

@section('content')
    <!-- Testimonial 3 - Bootstrap Brain Component -->
    <section class="bg-light py-5 py-xl-8">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-6 text-secondary mb-2 text-uppercase text-center">Happy Customers</h2>
                    <p class="display-5 mb-4 mb-md-5 text-center">We deliver what we promise. See what customers are expressing about us.</p>
                    <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container overflow-hidden">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($reviewGroups as $index => $group)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row align-items-stretch"> <!-- Ensure all cards have the same height -->
                                @foreach ($group as $review)
                                    <div class="col-12 col-md-4">
                                        <div class="card h-100 border-0 border-bottom border-primary shadow-sm rounded">
                                            <div class="card-body p-4 p-xxl-5">
                                                <figure>
                                                    <img class="img-fluid rounded-circle mb-4 border border-5" loading="lazy" src="{{ asset('storage/'.$review->profile_photo_url) }}" alt="{{ $review->user_name }}" width="100">
                                                    <figcaption>
                                                        <div class="reviews">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <span class="fa fa-star checked"></span>
                                                                @else
                                                                    <span class="fa fa-star"></span>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <blockquote class="bsb-blockquote-icon mb-4">{{ $review->review }}</blockquote>
                                                        <h4 class="mb-2">{{ $review->user_name }}</h4>
                                                        <h5 class="fs-6 text-secondary mb-0">{{ $review->location }}</h5>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <style>
            .fa {
                font-size: 20px;
                color: gray; /* Gold color */
                margin-right: 5px;
            }

            .checked {
                color: #f8b700; /* Lighter gold color for checked stars */
            }

            .card {
                transition: transform 0.3s;
            }

            .card:hover {
                transform: translateY(-5px); /* Add some hover effect */
            }
        </style>
    </section>
@endsection
