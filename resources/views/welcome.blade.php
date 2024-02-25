@extends('layouts.welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Yummy Tummy</title>


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Styles -->
    </head>

    <body>
        <div class="container">

        </div>





        <header class="section__container header__container" id="home">
            <div class="header__image">
                <img src="{{ url('welcome/header.png') }}" alt="header" />
            </div>
            <div class="header__content">
                <h1>Meet, Eat & Enjoy The<span>True Taste</span>.</h1>
                <p class="section__description">
                    Each recipe with the warmth and expertise that only home cooking can provide.
                </p>
                <div class="header__btn">
                    <button class="btn">Get Started</button>
                </div>
            </div>
        </header>

        <section class="section__container special__container" id="special">
            <h2 class="section__header">Our Special Dish</h2>
            <p class="section__description">
                Each dish promises an unforgettable dining experience, blending
                innovation with tradition to delight your senses.
            </p>
            <div class="special__grid">


            @foreach($products->take(6) as $product)


                <div class="special__card">
                    @auth
                    @csrf
                    @if(Auth::check() && Auth::user()->name)
                    <a href="{{ route('customer.viewCartProduct', $product->id) }}">
                        @endif
                        
                        @else
                        <a href="{{ route('login') }}">
                        @endauth
                            <img src="{{ url('products/'.$product->food_image) }}" alt="special" />
                            <h4>{{ $product->food_name }}</h4>
                            <p>
                                {{ $product->food_descriptions }}
                            </p>
                           
                            <div class="special__ratings">
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                            </div>
                            <div class="special__footer">
                                <p class="price">Rs. {{ $product->food_price }}</p>
                        </a>

                        @auth
                        <form action="{{ route('customer.carts.store') }}" method="post">
                            @csrf
                            @if(Auth::check() && Auth::user()->name)
                            <input type="hidden" name="customer_id" value="{{ Auth::user()->name }}">
                            @endif
                            <input type="hidden" name="chef_id" value='{{$product->chief_id}}'>
                            <input type="hidden" name="product_id" value='{{$product->id}}'>
                            <button type="submit" class="btn">Add to Cart</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn " style="text-decoration: none;">Add to cart</a>
                        @endauth



                </div>
            </div>

            @endforeach
            </div>
        </section>

        <section class="section__container explore__container">
            <div class="explore__image">
                <img src="{{ url('welcome/explore.png') }}" alt="explore" />
            </div>
            <div class="explore__content">
                <h1 class="section__header">We Serve Healthy & Tasty Food</h1>
                <p class="section__description">
                    Indulge guilt-free with our commitment to serving wholesome and
                    delicious meals. Explore a menu curated to balance taste and
                    nutrition, ensuring every bite is both satisfying and nourishing.
                </p>
                <div class="explore__btn">
                    <button class="btn">
                        Explore Story <span><i class="ri-arrow-right-line"></i></span>
                    </button>
                </div>
            </div>
        </section>

        <section class="section__container banner__container">
            <div class="banner__card">
                <span class="banner__icon"><i class="ri-bowl-fill"></i></span>
                <h4>Order Your Food</h4>
                <p>
                    Seamlessly place your food orders online with just a few clicks. Enjoy
                    convenience and efficiency as you select from our diverse menu of
                    delectable dishes.
                </p>
                <a href="#">
                    Read more
                    <span><i class="ri-arrow-right-line"></i></span>
                </a>
            </div>
            <div class="banner__card">
                <span class="banner__icon"><i class="ri-truck-fill"></i></span>
                <h4>Pick Your Food</h4>
                <p>
                    Customize your dining experience by choosing from a tantalizing array
                    of options. For savory, sweet, or in between craving, find the perfect
                    meal to satisfy your appetite.
                </p>
                <a href="#">
                    Read more
                    <span><i class="ri-arrow-right-line"></i></span>
                </a>
            </div>
            <div class="banner__card">
                <span class="banner__icon"><i class="ri-star-smile-fill"></i></span>
                <h4>Enjoy Your Food</h4>
                <p>
                    Sit back, relax, and savor the flavors as your meticulously prepared
                    meal arrives. Delight in the deliciousness of every bite, knowing that
                    your satisfaction is our top priority.
                </p>
                <a href="#">
                    Read more
                    <span><i class="ri-arrow-right-line"></i></span>
                </a>
            </div>
        </section>

        <section class="chef" id="chef">
            <img src="{{ url('welcome/topping.png') }}" alt="topping" class="chef__bg" />
            <div class="section__container chef__container">
                <div class="chef__image">
                    <img src="{{ url('welcome/chef.png') }}" alt="chef" />
                </div>
                <div class="chef__content">
                    <h2 class="section__header">Cooked By The Best Chefs In The World</h2>
                    <p class="section__description">
                        Experience culinary excellence crafted by master chefs from around
                        the globe. Our team of culinary virtuosos brings together expertise,
                        innovation, and passion to create unforgettable dining experiences
                        that redefine gastronomy.
                    </p>
                    <ul class="chef__list">
                        <li>
                            <span><i class="ri-checkbox-fill"></i></span>
                            Savour culinary brilliance from master chefs worldwide.
                        </li>
                        <li>
                            <span><i class="ri-checkbox-fill"></i></span>
                            Experience innovative creations with attention to detail.
                        </li>
                        <li>
                            <span><i class="ri-checkbox-fill"></i></span>
                            Enjoy dishes crafted with an unwavering passion for perfection.
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section__container client__container" id="client">
            <h2 class="section__header">What Our Customers Are Saying</h2>
            <p class="section__description">
                Discover firsthand experiences and testimonials from our valued patrons.
                Explore the feedback and reviews that showcase our commitment to
                quality, service, and customer satisfaction.
            </p>
            <div class="client__swiper">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="client__card">
                                <p>
                                    Yummy Tummies culinary expertise never fails to impress! Every
                                    dish is a masterpiece, bursting with flavor and freshness.
                                </p>
                                <img src="{{ url('welcome/client-1.jpg') }}" alt="client" />
                                <h4>Smriti Bhandari</h4>
                                <h5>Business Executive</h5>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client__card">
                                <p>
                                    I always turn to Yummy Tummy for a quick and delicious meal. Their
                                    efficient service and mouthwatering options never disappoint!
                                </p>
                                <img src="{{ url('welcome/client-2.jpg') }}" alt="client" />
                                <h4>Emily Johnson</h4>
                                <h5>Food Blogger</h5>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client__card">
                                <p>
                                    Yummy Tummies has become my go-to for all my catering needs. Their
                                    attention to detail and exceptional customer service make
                                    every event a success.
                                </p>
                                <img src="{{ url('welcome/client-3.jpg') }}" alt="client" />
                                <h4>Michael Thompson</h4>
                                <h5>Event Planner</h5>
                            </div>
                        </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <footer class="footer" id="contact">
            <div class="section__container footer__container">
                <div class="footer__col">
                    <div class="logo footer__logo">
                        <a href="#">Yummy<span>Tummy</span></a>
                    </div>
                    <p class="section__description">
                        Embark on a gastronomic journey with Yummy Tummy, where every bite tells
                        a story and every dish is crafted to perfection.
                    </p>
                </div>
                <div class="footer__col">
                    <h4>Product</h4>
                    <ul class="footer__links">
                        <li><a href="#">Menu</a></li>
                        <li><a href="#">Specials</a></li>
                        <li><a href="#">Meal Deals</a></li>
                        <li><a href="#">Catering Options</a></li>
                        <li><a href="#">Seasonal Offerings</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Information</h4>
                    <ul class="footer__links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Nutrition Information</a></li>
                        <li><a href="#">Allergen Information</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Company</h4>
                    <ul class="footer__links">
                        <li><a href="#">Our Story</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__bar">
                Copyright © 2024 Yummy Tummy. All rights reserved.
            </div>
        </footer>

        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    </body>

</html>
@endsection