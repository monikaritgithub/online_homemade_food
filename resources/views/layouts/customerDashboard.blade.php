<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Yummy Tummy</title>

        <!-- External Stylesheets -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        @stack('css')

        <!-- Custom Stylesheet -->
        <style>
            /* Navbar Styling */
            body {
                margin: 0;
                background: #F3F4F6;

            }

            .navbar {
                position: relative;
                margin: auto;
                width: 90%;
                background: #F3F4F6;
                padding: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .navbar-logo {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                margin-left: 20px;
                display: flex;
            }

            .search-bar {
                flex-grow: 1;
                margin: 0 20px;
            }

            .search-bar input {
                width: 70%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .navbar-menu {
                display: flex;
                align-items: left;
            }

            .navbar-menu a {
                margin: 0 10px;
                color: #333;
                text-decoration: none;
                font-weight: bold;
            }

            .navbar-menu .dropdown-menu {
                position: absolute;
                top: 23px;
                left: 0;
                background: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                display: none;
            }

            .navbar-menu .dropdown:hover .dropdown-menu {
                display: block;
            }

            .user-logo {
                width: 30px;
                height: 30px;
                object-fit: cover;
                margin-left: 10px;
                border-radius: 50%;
            }

            /* Responsive Styling */
            @media only screen and (max-width: 768px) {
                .navbar {
                    flex-direction: column;
                    align-items: flex-start;
                    padding: 15px;
                }

                .navbar-menu {
                    margin-top: 10px;
                }

                .navbar-menu a {
                    margin: 0 0 10px 0;
                }
            }
        </style>
    </head>

    <body>

        <!-- Responsive Navbar -->
        <div class="navbar">
            <!-- yummy tummy navbar svg -->
            <a href="/customer/view-product-location">
                <div class="navbar-logo ">
                    <svg width="38" height="31" viewBox="0 0 38 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M27.9662 29.16C27.4502 27.3308 27.3284 25.413 27.6088 23.5332C26.4294 24.2433 25.0344 24.5062 23.6776 24.2738C25.1527 23.8562 26.4789 23.028 27.5017 21.8857C28.5246 20.7434 29.202 19.3339 29.4552 17.8213C29.6567 18.3351 29.7717 18.8787 29.7956 19.4301C29.844 20.3462 29.6189 21.2559 29.1489 22.0435C29.1064 22.1286 28.9277 22.2819 29.2085 22.2904C30.392 22.3748 31.5805 22.2244 32.7057 21.8477C33.3089 21.6388 33.8485 21.2787 34.273 20.8018C34.6975 20.325 34.9929 19.7472 35.1307 19.1237C35.4343 18.009 35.4343 16.8334 35.1307 15.7187C34.9649 15.0982 34.6582 14.5243 34.2347 14.0415C33.8112 13.5587 33.2822 13.1801 32.6887 12.9351C31.6708 12.4835 30.5764 12.2293 29.4638 12.186C28.6104 12.1431 27.755 12.1887 26.911 12.3222C26.4856 12.3903 26.4771 12.3818 26.4771 11.9306C26.5189 10.6993 26.3254 9.47142 25.907 8.31277C25.5063 7.05819 24.7747 5.93499 23.7893 5.06156C22.8039 4.18813 21.6012 3.59682 20.3081 3.34995C18.3948 2.87523 16.3902 2.9134 14.4964 3.46061C13.1603 3.83801 11.9454 4.55684 10.9711 5.5464C9.99691 6.53596 9.29692 7.76217 8.94003 9.10443C8.35382 10.9148 8.37773 12.8677 9.00811 14.6631C9.19769 15.2285 9.48577 15.7559 9.85901 16.2209C9.90237 16.2522 9.93797 16.293 9.96305 16.3403C9.98813 16.3875 10.002 16.4399 10.0037 16.4933C9.703 16.3166 9.4329 16.0924 9.20382 15.8293C8.22306 14.6955 7.60632 13.2924 7.43394 11.8029C7.42571 11.7095 7.42571 11.6155 7.43394 11.522C7.43394 11.3092 7.30631 11.2581 7.11911 11.2836C5.78069 11.4126 4.51615 11.9573 3.50278 12.8414C2.95207 13.3644 2.53657 14.0134 2.292 14.7326C2.04744 15.4517 1.98114 16.2196 2.0988 16.97C2.16107 17.7826 2.46384 18.5583 2.96848 19.198C3.47312 19.8378 4.15678 20.3128 4.93229 20.5623C5.94876 20.9694 7.03709 21.1663 8.13168 21.1412C8.24459 21.1265 8.35901 21.1528 8.45422 21.2153C8.54944 21.2777 8.61914 21.3722 8.65073 21.4817C9.16189 22.7595 9.44971 24.1157 9.50163 25.4911C9.55754 26.0572 9.55754 26.6275 9.50163 27.1936C9.50163 27.483 9.65479 27.3979 9.79944 27.3553C10.8445 27.0506 11.9112 26.8258 12.9903 26.6828C14.6114 26.463 16.2499 26.4003 17.883 26.4956C19.5545 26.547 21.2031 26.8988 22.7501 27.5341C23.9232 28.0293 24.9915 28.7428 25.8985 29.6367C25.9495 29.6878 25.9921 29.7474 26.0346 29.7984C26.0772 29.8495 25.9155 29.7984 25.8644 29.7984C24.1785 29.1507 22.4123 28.7354 20.6144 28.5641C19.2437 28.3825 17.8615 28.3028 16.479 28.3258C13.8988 28.3399 11.3422 28.8186 8.93152 29.7388C8.438 29.9431 7.9615 30.1815 7.47649 30.4028C7.37438 30.4454 7.25525 30.556 7.15314 30.4879C7.05103 30.4198 7.15314 30.2496 7.15314 30.1389C7.26376 29.3813 7.43394 28.6322 7.485 27.8661C7.63291 26.3629 7.541 24.8458 7.21271 23.3715C7.20412 23.2834 7.16244 23.2019 7.0961 23.1435C7.02976 23.085 6.9437 23.0539 6.85533 23.0565C5.2839 22.8909 3.78109 22.3252 2.49021 21.4136C1.5336 20.7313 0.827946 19.7532 0.482086 18.63C-0.00640504 17.0847 0.0264838 15.4217 0.575686 13.897C0.907574 12.9856 1.44243 12.1617 2.13974 11.4877C2.83705 10.8137 3.67853 10.3072 4.60044 10.0068C5.39294 9.70278 6.22309 9.50804 7.06805 9.42791C7.32332 9.42791 7.42543 9.2832 7.45947 9.03633C7.67157 7.21499 8.43849 5.50297 9.6562 4.13247C10.8739 2.76197 12.4835 1.79931 14.2667 1.37504C16.6441 0.744538 19.1491 0.779874 21.5078 1.47719C23.141 1.93639 24.6205 2.82675 25.7912 4.0549C26.962 5.28306 27.7808 6.80374 28.1619 8.45748C28.2721 8.84027 28.3574 9.22983 28.4171 9.6237C28.4682 9.93015 28.5703 10.0408 28.9022 10.0493C30.5951 10.0215 32.2727 10.3734 33.8119 11.0793C34.8306 11.5566 35.7022 12.2991 36.3355 13.2291C36.9687 14.1592 37.3403 15.2425 37.4112 16.3656C37.5588 17.6408 37.4163 18.9329 36.9942 20.1452C36.6664 21.0799 36.1022 21.9139 35.3567 22.5657C34.6111 23.2176 33.7095 23.6653 32.7397 23.8652C31.6421 24.1468 30.4991 24.2047 29.3787 24.0354C29.0979 24.0354 29.0043 24.1035 28.9277 24.3334C28.5372 25.4966 28.2886 26.7028 28.1874 27.9257C28.1874 28.3343 28.1108 28.7769 28.0768 29.16H27.9662Z"
                            fill="#B11F24" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.93199 14.7236L0.674194 0.116089H5.67749L12.1103 10.7057L18.6367 0.116089H23.4443L14.2546 14.7236V23.5H9.93199V14.7236Z"
                            fill="#B11F24" />
                    </svg>
                    <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.3857 0.904602V18.5H12.2078V16.1591C11.592 17.0259 10.7742 17.7294 9.82527 18.2085C8.8763 18.6877 7.82483 18.928 6.76203 18.9086C2.91596 18.9086 0.227112 16.091 0.227112 12.0986V0.904602H4.24336V11.2899C4.24336 13.6734 5.77498 15.3759 7.95329 15.3759C8.94309 15.416 9.91481 15.1022 10.6944 14.4908C11.474 13.8793 12.0105 13.0102 12.2078 12.039V0.904602H16.3857Z"
                            fill="#B11F24" />
                    </svg>

                    <svg width="27" height="19" viewBox="0 0 27 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M26.9971 7.30607V18.5001H22.9893V7.97004C22.9893 5.65463 21.5938 4.02022 19.5857 4.02022C19.0862 3.98574 18.585 4.05591 18.1141 4.22623C17.6432 4.39656 17.213 4.66329 16.8511 5.00939C16.4891 5.35549 16.2033 5.77335 16.0119 6.23623C15.8205 6.69912 15.7278 7.19686 15.7396 7.69764V18.5001H11.6894V7.97004C11.6894 5.65463 10.3024 4.02022 8.28576 4.02022C7.78713 3.98966 7.28757 4.06253 6.81843 4.23427C6.34929 4.40601 5.92069 4.67291 5.55954 5.01822C5.1984 5.36353 4.91251 5.77979 4.71979 6.24088C4.52708 6.70197 4.43171 7.19793 4.43968 7.69764V18.5001H0.287292V0.904632H4.43968V3.28814C4.9166 2.41309 5.62783 1.68831 6.49356 1.19511C7.3593 0.701922 8.34528 0.459841 9.34088 0.49603C10.4941 0.471288 11.6311 0.77094 12.6224 1.36088C13.6138 1.95081 14.4196 2.80734 14.9483 3.83295C15.7992 1.78994 18.0115 0.49603 20.6323 0.49603C24.2401 0.49603 26.9971 3.32219 26.9971 7.30607Z"
                            fill="#B11F24" />
                    </svg>
                    <svg width="27" height="19" viewBox="0 0 27 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M26.9971 7.30607V18.5001H22.9893V7.97004C22.9893 5.65463 21.5938 4.02022 19.5857 4.02022C19.0862 3.98574 18.585 4.05591 18.1141 4.22623C17.6432 4.39656 17.213 4.66329 16.8511 5.00939C16.4891 5.35549 16.2033 5.77335 16.0119 6.23623C15.8205 6.69912 15.7278 7.19686 15.7396 7.69764V18.5001H11.6894V7.97004C11.6894 5.65463 10.3024 4.02022 8.28576 4.02022C7.78713 3.98966 7.28757 4.06253 6.81843 4.23427C6.34929 4.40601 5.92069 4.67291 5.55954 5.01822C5.1984 5.36353 4.91251 5.77979 4.71979 6.24088C4.52708 6.70197 4.43171 7.19793 4.43968 7.69764V18.5001H0.287292V0.904632H4.43968V3.28814C4.9166 2.41309 5.62783 1.68831 6.49356 1.19511C7.3593 0.701922 8.34528 0.459841 9.34088 0.49603C10.4941 0.471288 11.6311 0.77094 12.6224 1.36088C13.6138 1.95081 14.4196 2.80734 14.9483 3.83295C15.7992 1.78994 18.0115 0.49603 20.6323 0.49603C24.2401 0.49603 26.9971 3.32219 26.9971 7.30607Z"
                            fill="#B11F24" />
                    </svg>
                    <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.06745 23.7097L2.91835 20.7133C3.6062 21.1019 4.37564 21.3235 5.16473 21.3602C5.61027 21.3995 6.05779 21.3115 6.45539 21.1066C6.85299 20.9017 7.18437 20.5882 7.41111 20.2025L8.1599 18.6447L0.740051 0.904602H5.1307L10.2361 14.048L15.0607 0.904602H19.3152L11.9379 19.7258C10.602 23.0628 8.5343 24.595 5.91353 24.6291C4.57682 24.6316 3.25863 24.3165 2.06745 23.7097Z"
                            fill="#B11F24" />
                    </svg>

                    <svg width="12" height="23" viewBox="0 0 12 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.9896 21.5126C10.9417 22.3935 9.62263 22.8865 8.25413 22.9086C7.58381 22.9312 6.91616 22.8135 6.29396 22.563C5.67175 22.3124 5.10872 21.9347 4.64091 21.4538C4.1731 20.973 3.81084 20.3997 3.57732 19.7707C3.34381 19.1417 3.24421 18.4709 3.28488 17.8011V8.34368H0.732178V4.93866H3.28488V0.0524597H7.33516V4.90461H11.3174V8.30963H7.33516V17.3329C7.30941 17.5795 7.33331 17.8287 7.40543 18.0658C7.47755 18.303 7.59644 18.5233 7.75507 18.7137C7.9137 18.9042 8.10885 19.0609 8.32902 19.1746C8.54919 19.2884 8.78991 19.3568 9.03696 19.3759C9.66443 19.3769 10.2703 19.1465 10.7388 18.729L11.9896 21.5126Z"
                            fill="#0A4E29" />
                    </svg>
                    <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.5862 0.904602V18.5H12.4338V16.1591C11.8199 17.0258 11.0036 17.7293 10.056 18.2085C9.10843 18.6877 8.05815 18.9281 6.99653 18.9086C3.15046 18.9086 0.461609 16.091 0.461609 12.0986V0.904602H4.47786V11.2899C4.47786 13.6734 6.00949 15.3759 8.17928 15.3759C9.16908 15.416 10.1408 15.1022 10.9204 14.4908C11.7 13.8793 12.2365 13.0102 12.4338 12.039V0.904602H16.5862Z"
                            fill="#0A4E29" />
                    </svg>
                    <svg width="28" height="19" viewBox="0 0 28 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M27.1975 7.30604V18.5H23.1472V7.97001C23.1472 5.6546 21.7517 4.02019 19.7436 4.02019C19.2441 3.98571 18.7429 4.05588 18.272 4.2262C17.8011 4.39653 17.371 4.66326 17.009 5.00936C16.647 5.35547 16.3612 5.77332 16.1698 6.23621C15.9784 6.69909 15.8857 7.19683 15.8976 7.69761V18.5H11.8473V7.97001C11.8473 5.6546 10.4518 4.02019 8.44366 4.02019C7.94503 3.98963 7.44549 4.0625 6.97635 4.23424C6.50721 4.40598 6.07862 4.67288 5.71747 5.01819C5.35633 5.3635 5.07042 5.77976 4.87771 6.24085C4.685 6.70194 4.58963 7.19791 4.5976 7.69761V18.5H0.419678V0.904603H4.56357V3.28812C5.03852 2.41703 5.74574 1.69486 6.60652 1.20192C7.4673 0.708979 8.44789 0.464612 9.43923 0.496002C10.5939 0.469651 11.7327 0.768541 12.7257 1.35857C13.7187 1.94859 14.5259 2.80599 15.0552 3.83292C15.9061 1.78991 18.1184 0.496002 20.7392 0.496002C24.4406 0.496002 27.1975 3.32217 27.1975 7.30604Z"
                            fill="#0A4E29" />
                    </svg>
                    <svg width="28" height="19" viewBox="0 0 28 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M27.1975 7.30604V18.5H23.1472V7.97001C23.1472 5.6546 21.7517 4.02019 19.7436 4.02019C19.2441 3.98571 18.7429 4.05588 18.272 4.2262C17.8011 4.39653 17.371 4.66326 17.009 5.00936C16.647 5.35547 16.3612 5.77332 16.1698 6.23621C15.9784 6.69909 15.8857 7.19683 15.8976 7.69761V18.5H11.8473V7.97001C11.8473 5.6546 10.4518 4.02019 8.44366 4.02019C7.94503 3.98963 7.44549 4.0625 6.97635 4.23424C6.50721 4.40598 6.07862 4.67288 5.71747 5.01819C5.35633 5.3635 5.07042 5.77976 4.87771 6.24085C4.685 6.70194 4.58963 7.19791 4.5976 7.69761V18.5H0.419678V0.904603H4.56357V3.28812C5.03852 2.41703 5.74574 1.69486 6.60652 1.20192C7.4673 0.708979 8.44789 0.464612 9.43923 0.496002C10.5939 0.469651 11.7327 0.768541 12.7257 1.35857C13.7187 1.94859 14.5259 2.80599 15.0552 3.83292C15.9061 1.78991 18.1184 0.496002 20.7392 0.496002C24.4406 0.496002 27.1975 3.32217 27.1975 7.30604Z"
                            fill="#0A4E29" />
                    </svg>
                    <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.26795 23.7097L3.11885 20.7133C3.8067 21.1019 4.57615 21.3235 5.36524 21.3602C5.81078 21.3995 6.2583 21.3115 6.6559 21.1066C7.0535 20.9017 7.38487 20.5882 7.61161 20.2025L8.3604 18.6447L0.940552 0.904602H5.3312L10.4366 14.048L15.2697 0.904602H19.5242L12.0703 19.7258C10.7429 23.0628 8.66674 24.595 6.05447 24.6291C4.73791 24.6222 3.44118 24.3074 2.26795 23.7097Z"
                            fill="#0A4E29" />
                    </svg>

                </div>
            </a>

            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search your product">
                <button id="search-button" class="btn bg-white" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>

            <div class="navbar-menu">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" id="productsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Products</a>
                    <div class="dropdown-menu" aria-labelledby="productsDropdown">
                        <a class="dropdown-item" href="{{ route('customer.viewProductByLocation') }}"> In
                            {{ Auth::user()->location }}</a>
                        <a class="dropdown-item" href="{{ route('customer.viewProduct') }}">All Location</a>
                    </div>
                </div>
                <a href="{{ route('customer.viewMyCartProduct') }}">Cart</a>
                <a href="#">My Order</a>
                <a href="#">Payments</a>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" id="productsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu" aria-labelledby="productsDropdown">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                style="border: none; background: none; cursor: pointer;">
                                Log Out
                            </button>
                        </form>

                    </div>


                </div>
            </div>
        </div>
        @yield('content')
        <!-- External Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                // Function to perform search
                function performSearch() {
                    var searchTerm = $('#search-input').val().trim();
                    if (searchTerm) {
                        // Perform search action using searchTerm
                        // For example, redirect to the search results page
                        window.location.href = "{{ route('search.products') }}?search=" + searchTerm;
                    }
                }

                // Click event handler for the search button
                $('#search-button').click(function () {
                    performSearch();
                });

                // Keypress event handler for the input field
                $('#search-input').keypress(function (e) {
                    if (e.which == 13) { // 13 is the key code for Enter
                        performSearch();
                    }
                });
            });
        </script>

    </body>

</html>