<section class="">
    <!-- Full Screen Overlay Menu -->
    <div id="fullscreenMenu" class="overlay">
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
            <a href="{{route('contact')}}"
                class="menuUnderline {{ request()->routeIs('contact') ? 'active' : '' }}">Contact us</a>
        </div>
    </div>

    <div class="d-flex justify-content-between" style="width: 100%;">
        <div class="col-md-4">
            <div class="btn_menuTwo in-left" style="z-index: 2" bis_skin_checked="1" onclick="openMenu()">
                <div class="animate__animated animate__fadeInLeft animate__slower animate__delay-2s">
                    <div id="click_fixed" class="row_flex open" bis_skin_checked="1">
                        <div class="box_sticks" bis_skin_checked="1">
                            <div id="stick1" class="stick" bis_skin_checked="1"></div>
                            <div id="stick2" class="stick" bis_skin_checked="1"></div>
                            <div id="stick3" class="stick" bis_skin_checked="1"></div>
                            <div class="label_stick" bis_skin_checked="1">MENU</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 headerLogo">
            <a href="{{ route('home') }}">
                <img width="auto" height="130px"
                    class="animate__animated animate__fadeInDown animated-slow animate__slower"
                    src="{{asset('/')}}assets/web/media/brand-logo1.png" alt="">
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('bookNow')}}"
                class="booknowHomeTwo animate__animated animate__fadeInRight animate__slower animate__delay-2s">
                <div><i class="fa-solid fa-calendar-days"></i></div>
                <span class="booknow">Book Now</span>
            </a>
        </div>
    </div>
</section>