document.querySelector('.header-button-hamburger').addEventListener('click', function () {
    document.querySelector('.header-menu').classList.toggle('is-show')
    this.classList.toggle('is-show')
})

document.querySelectorAll('.product-content-favorite-button').forEach(function (item) {
    item.addEventListener('click', function () {
        this.classList.toggle('is-fav')
    })
})

document.querySelectorAll('.product-quantity-input-increase').forEach(function (item) {
    item.addEventListener('click', function () {
        var input = this.parentElement.querySelector('.product-quantity-input-number');
        var currentValue = parseInt(input.value);
        var maxValue = input.getAttribute('max');
        if (maxValue && currentValue >= maxValue) {
            input.value = maxValue;
        } else {
            input.value = currentValue + 1;
        }
    })
})

document.querySelectorAll('.product-quantity-input-decrease').forEach(function (item) {
    item.addEventListener('click', function () {
        var input = this.parentElement.querySelector('.product-quantity-input-number');
        var currentValue = parseInt(input.value);
        var minValue = input.getAttribute('min');
        if (minValue && currentValue <= minValue) {
            input.value = minValue;
        } else {
            input.value = currentValue - 1;
        }
    })
})

document.querySelector('.header-button-search').addEventListener('click', function () {
    document.querySelector('.header-button').classList.toggle('is-show')
    this.classList.toggle('is-show')
})


if (document.querySelector('.product-swiper')) {
    var productThumbs = new Swiper('.product-thumb-swiper', {
        spaceBetween: 12,
        slidesPerView: 'auto',
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
            768: {
                spaceBetween: 24,
            }
        }
    });

    var productSwiper = new Swiper('.product-swiper', {
        slidesPerView: 1,
        loop: true,
        thumbs: {
            swiper: productThumbs,
            slideThumbActiveClass: 'is-active'
        },
        on: {
            slideChange: function (swiper) {
                document.querySelector('.product-image-number-bold').textContent = (swiper.realIndex + 1).toString().padStart(2, '0');
            }
        }
    });

    document.querySelector('.product-image-order-next').addEventListener('click', function () {
        productSwiper.slideNext();
    })

    document.querySelector('.product-image-order-previous').addEventListener('click', function () {
        productSwiper.slidePrev();
    })
}




document.addEventListener("DOMContentLoaded", function() {
    var quantityInput = document.getElementById("quantity");
    
    quantityInput.addEventListener("input", function() {
        var currentValue = parseInt(quantityInput.value);
        
        if (isNaN(currentValue) || currentValue < 1) {
            quantityInput.value = 1; // Ensure minimum quantity is 1
        } else if (currentValue > 5) {
            quantityInput.value = 5; // Ensure maximum quantity is 5
        }
        
        // Here you can add any additional logic you need, such as updating the cart or making an AJAX request to update the quantity on the server.
    });
});

function decreaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        // Here you can add any additional logic you need, such as updating the cart or making an AJAX request to update the quantity on the server.
    }
}

function increaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentValue = parseInt(quantityInput.value);
    if (currentValue < 5) { // Assuming max quantity is 5
        quantityInput.value = currentValue + 1;
        // Here you can add any additional logic you need, such as updating the cart or making an AJAX request to update the quantity on the server.
    }
}
