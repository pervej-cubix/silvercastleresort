<style>
    .carousel-inner .carousel-item{
        height: 100vh;
        position: relative;
    }

.carousel-item img,
.carousel-item video {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures video & image fill the container */
}
</style>

<section>
    <!-- Full Screen Overlay Menu -->
    <div id="fullscreenMenu" class="overlay" style="height: 100vh;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <div class="overlay-content">
            <a href="{{ route('home') }}"
                class="menuUnderline {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{route('accommodation')}}"
                class="menuUnderline {{ request()->routeIs('accommodation') ? 'active' : '' }}">Accommodation</a>
            <a href="{{route('dining')}}"
                class="menuUnderline {{ request()->routeIs('dining') ? 'active' : '' }}">Dining</a>
            <a href="{{route('promotion')}}"
                class="menuUnderline {{ request()->routeIs('promotion') ? 'active' : '' }}">Promotions</a>
            <a href="{{route('meetingsEvents')}}"
                class="menuUnderline {{ request()->routeIs('meetingsEvents') ? 'active' : '' }}">Meetings & Events</a>
            {{-- <a href="{{route('recreation')}}"
                class="menuUnderline {{ request()->routeIs('recreation') ? 'active' : '' }}">Recreation</a> --}}
            {{-- <a href="{{route('payOnLine')}}"
                class="menuUnderline {{ request()->routeIs('payOnLine') ? 'active' : '' }}">Pay one line</a> --}}
            {{-- <a href="{{route('virtualTours')}}"
                class="menuUnderline {{ request()->routeIs('virtualTours') ? 'active' : '' }}">Virtual Tours</a> --}}
            <a href="{{route('photoGallery')}}"
                class="menuUnderline {{ request()->routeIs('photoGallery') ? 'active' : '' }}">Photo gallery</a>
            <a href="{{route('hotelPolicy')}}"
                class="menuUnderline {{ request()->routeIs('hotelPolicy') ? 'active' : '' }}">Hotel Policy</a>
            <a href="{{route('graceStars')}}"
                class="menuUnderline {{ request()->routeIs('graceStars') ? 'active' : '' }}">Silvercastle Stars</a>
            {{-- <a href="{{route('hotelPolicy')}}"
                class="menuUnderline {{ request()->routeIs('hotelPolicy') ? 'active' : '' }}">Hotel Policy</a> --}}
            <a href="{{route('contact')}}"
                class="menuUnderline {{ request()->routeIs('contact') ? 'active' : '' }}">Contact us</a>
        </div>
    </div>
    <div class="logo animate__animated animate__fadeInDown">
        <a href="{{ route('home') }}">
            <img width="100px" height="auto" src="{{asset('/')}}assets/web/media/brand-logo.png" alt="">
        </a>
    </div>
    <a href="{{route('bookNow')}}" class="booknowHome animate__animated animate__fadeInRight">
        <div><i class="fa-solid fa-calendar-days"></i></div>
        <span class="booknow">Book Now</span>
    </a>

    <!-- <a href="{{ route('promotion') }}#target-section" class="offer" onclick="toggleOfferImg(event)">
            <i class="fa-solid fa-gift"></i>
            <span class="vericaltext">
                SPECIAL OFFERS
            </span>
            <div class="offerImg">
                <img src="{{ asset('/') }}assets/web/images/offer1.jpg" alt="">
                <button class="offerButton">View</button>
            </div>
        </a> -->

    @if ($special)
    <div class="offer" onclick="toggleOfferImg(event)">
        <i class="fa-solid fa-gift"></i>
        <span class="vericaltext">
            SPECIAL OFFERS
        </span>
        <div class="offerImg">
            <a href="{{ route('promotion') }}#target-section" onclick="redirectToPromotion(event)">
                <img src="{{ asset($special->image) }}" alt="">
            </a>
        </div>
    </div>
    @endif 

    <div class="btn_menu in-left" bis_skin_checked="1" onclick="openMenu()">
        <div id="click_trigger" class="row_flex open" bis_skin_checked="1">
            <div class="box_sticks animate__animated animate__fadeInLeft" bis_skin_checked="1">
                <div id="stick1" class="stick" bis_skin_checked="1"></div>
                <div id="stick2" class="stick" bis_skin_checked="1"></div>
                <div id="stick3" class="stick" bis_skin_checked="1"></div>
                <div class="label_stick" bis_skin_checked="1">MENU</div>
            </div>
        </div>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($homepage_sliders as $index => $slider)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="carousel-overlay"></div> <!-- Dark overlay -->
                @if($slider->fileType == 'video')
                    <video class="be-bg-video d-block w-100" autoplay="autoplay" loop="loop" muted="muted" preload="auto">
                        <source src="{{ asset('/assets/web/homepageSlider/' . $slider->file) }}" type="video/mp4">
                    </video>
                @else
                    <img class="img-fluid" src="{{ asset('/assets/web/homepageSlider/' . $slider->file) }}" alt="Slide Image" class="d-block w-100">
                @endif
            </div>
        @endforeach
    </div>

    <!-- Dynamic Indicators -->
    <div class="carousel-indicators">
        @foreach($homepage_sliders as $index => $slider)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" 
                class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span aria-hidden="true">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span aria-hidden="true">
                <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
            </span>
            <span class="visually-hidden">Next</span>
        </button>
</div>

   
</section>