    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- End Hero section -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{asset('/')}}assets/web/js/index.js"></script>

    <!-- owl-carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"
        integrity="sha512-9CWGXFSJ+/X0LWzSRCZFsOPhSfm6jbnL+Mpqo0o8Ke2SYr8rCTqb4/wGm+9n13HtDE1NQpAEOrMecDZw4FXQGg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Font awesome js link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/solid.min.js"
        integrity="sha512-L2znesU64H/rvdnaD4WBaRAmEcGvhBsVLXygPkhpgpUwcgjymD4amy68shdgZgLiIvyvV/vHRXAM4mTV8xqp+Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
new WOW().init();
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <script>
$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        nav: true, // Enable navigation buttons
        dots: false,
        navText: [
            '<i class="fa fa-chevron-left"></i>', // Previous button
            '<i class="fa fa-chevron-right"></i>' // Next button
        ],
        items: 3,
        slideBy: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});
    </script>


    <!-- Scrolling Motion -->
    <script>
document.addEventListener('scroll', function() {
    const animatedElements = document.querySelectorAll('.fade-in');
    const viewportHeight = window.innerHeight;

    animatedElements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;

        // Trigger animation when the element is in the viewport
        if (elementPosition < viewportHeight) {
            const animationType = element.getAttribute('data-animation');
            element.classList.add('animate__animated', `animate__${animationType}`);
        }
    });
});
    </script>

    <!-- Menu scrolling fixed  -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    window.onscroll = function() {
        const bookNowMenu = document.querySelector('.booknowHome');
        const clickTriggerMenu = document.querySelector('#click_trigger');
        const scrollTrigger = 100; // Change this value to adjust when the effect occurs

        // Handle .booknowHome
        if (document.body.scrollTop > scrollTrigger || document.documentElement.scrollTop > scrollTrigger) {
            bookNowMenu.classList.add('fixed');
        } else {
            bookNowMenu.classList.remove('fixed');
        }

        // Handle #click_trigger
        if (document.body.scrollTop > scrollTrigger || document.documentElement.scrollTop > scrollTrigger) {
            clickTriggerMenu.classList.add('fixed');
        } else {
            clickTriggerMenu.classList.remove('fixed');
        }
    };
});
    </script>


    <!-- Special Offer Image  -->
    <!-- <script>
            function toggleOfferImg(event) {
                event.preventDefault(); // Prevent default link behavior

                const offerImg = event.currentTarget.querySelector('.offerImg');

                if (offerImg.classList.contains('active')) {
                    // Remove the class immediately
                    offerImg.classList.remove('active');
                } else {
                    // Add the class immediately
                    offerImg.classList.add('active');
                }
            }
        </script> -->


    <script>
function toggleOfferImg(event) {
    event.stopPropagation(); // Stop the event from bubbling up
    const offerImg = event.currentTarget.querySelector('.offerImg');

    // Toggle the visibility of the image overlay
    offerImg.classList.toggle('active');
}

function redirectToPromotion(event) {
    // This function lets the image click follow the link without toggling visibility
    event.stopPropagation(); // Stop the click event on image from toggling the visibility
}
    </script>