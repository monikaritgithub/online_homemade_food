@extends(Auth::check() ? 'layouts.customerDashboard' : 'layouts.welcome')

@section('content')
<!DOCTYPE html>
<html lang="en" class="htmlclass">
<head>
    <meta charset="UTF-8">
    <title>Ratings and Review</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&display=swap");

        /* Your additional CSS */
        .custom-font-size {
            font-size: 16px;
            font-family: "Space Grotesk", sans-serif;
        }

        .customer-body {
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #222;
            font-size: 16px;
            font-family: "Space Grotesk", sans-serif;
            background-color: #F3F4F6;
            box-sizing: border-box;
        }

        .wrapper {
            width: 40rem;
            min-height: 80vh;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
            border-radius: 0.25rem;
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.2);
            background-color: #f0f5fc;
            z-index: 1;
        }

        .wrapper .title {
            font-weight: bold;
            font-size: 2rem;
        }

        .wrapper .content {
            line-height: 1.6;
            color: #555;
            font-size: 1rem;
        }

        .rate-box {
            display: flex;
            flex-direction: row-reverse;
            gap: 0.1rem;
        }

        .rate-box input {
            display: none;
        }

        .rate-box input:hover ~ .star:before {
            color: rgba(255, 204, 51, 0.5);
        }

        .rate-box input:active + .star:before {
            transform: scale(0.9);
        }

        .rate-box input:checked ~ .star:before {
            color: #ffcc33;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
        }

        .rate-box .star:before {
            content: "★";
            display: inline-block;
            font-family: "Potta One", cursive;
            font-size: 3rem;
            cursor: pointer;
            color: #0000;
            text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.5);
            background-color: #aaa;
            background-clip: text;
            -webkit-background-clip: text;
            transition: all 0.3s;
        }

        textarea {
            border: none;
            resize: none;
            width: 100%;
            padding: 0.8rem;
            color: inherit;
            font-family: inherit;
            line-height: 1.5;
            border-radius: 0.5rem;
            box-shadow: inset 0.2rem 0.2rem 0.8rem rgba(0, 0, 0, 0.3), inset -0.2rem -0.2rem 0.8rem rgba(255, 255, 255, 0.8);
            background-color: rgba(255, 255, 255, 0.3);
        }

        textarea::placeholder {
            color: #aaa;
        }

        textarea:focus {
            outline-color: #ffcc33;
        }

        .submit-btn {
            padding: 0.6rem 1.2rem;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
            border-radius: 1rem;
            cursor: pointer;
            background-color: green;
            transition: all 0.2s;
        }

        .submit-btn:active {
            transform: translate(2px, 2px);
        }
    </style>
</head>
<body class="custom-font-size">
    <div class="customer-body">
        <div class="wrapper">
            <div class="title">Rate your experience for {{ $product->food_name }}</div>
            <div class="content">We highly value your feedback! Kindly take a moment to rate your experience and provide us with your valuable feedback.</div>
            <div class="rate-box">
                <input type="radio" name="rating" value="5" id="5"><label class="star" for="5"></label>
                <input type="radio" name="rating" value="4" id="4"><label class="star" for="4"></label>
                <input type="radio" name="rating" value="3" id="3"><label class="star" for="3"></label>
                <input type="radio" name="rating" value="2" id="2"><label class="star" for="2"></label>
                <input type="radio" name="rating" value="1" id="1"><label class="star" for="1"></label>
            </div>
            <textarea cols="30" rows="6" placeholder="Tell us about your experience!" name="review" id="review"></textarea>
            <button type="button" class="submit-btn" onclick="submitForm()">Send</button>
        </div>
    </div>

    <script>
        function submitForm() {
            var rating = document.querySelector('input[name="rating"]:checked');
            var review = document.getElementById('review').value;

            // Perform validation if needed

            // Create a FormData object and append data
            var formData = new FormData();
            formData.append('product_id', '{{ $product->id }}');
            formData.append('rating', rating ? rating.value : '');
            formData.append('review', review);

            // Send AJAX request to submit the form data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("customer.reviews.store") }}', true);
            xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Request was successful
                    // console.log('Review added successfully.');
                    window.location.href = '/customer/cart/{{ $product->id }}';
                } else {
                    // Request failed
                    console.error('Failed to add review.');
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>
@endsection
