@extends('web.main')

@section('content')


<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Recreation</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 m-auto">
                <p style="text-align: justify;">Hotel Grace21 offers a diverse range of dining options to
                    delight every guest. Our restaurant features an impressive buffet menu, including breakfast, lunch,
                    and dinner, ensuring a variety of delectable dishes to satisfy all palates. For those seeking
                    flexibility, our à la carte menu is available 24/7, allowing guests to enjoy meals at their
                    convenience. Additionally, our on-premise coffee shop provides a cozy ambiance for guests to relax
                    and savor freshly brewed beverages. ​

                    Our skilled chefs are dedicated to crafting culinary delights that will leave a lasting impression,
                    making your dining experience at Hotel Grace21 truly memorable. ​
                    <br/>
                    For reservations or inquiries, please contact us at +8801700707724 or email
                    reservation@hotelgrace21.com</p>
            </div>
        </div>
    </div>
</section>

<!-- <section>
    <div class="container mt-5">
        <div class="row">
            @foreach($recreations as $recreation)
            <div class="col-md-6 animate__animated animate__fadeInLeftBig mt-3"
                style="animation-duration: 1.5s; animation-delay: 0.5s;">
                <a href="{{ asset($recreation->image) }}" data-lightbox="dining-gallery-{{ $recreation->id }}">
                    <img class="zoom-out" style="width: 100%; height:400px" src="{{ asset($recreation->image) }}"
                        alt="Recreation Thumbnail">
                </a>

                @foreach($recreation->recreation_galleries as $gallery)
                <a href="{{ asset($gallery->recreation_photo) }}" data-lightbox="dining-gallery-{{ $recreation->id }}"
                    style="display: none;">
                    <img src="{{ asset($gallery->recreation_photo) }}" alt="">
                </a>
                @endforeach

                <a href="{{ asset($recreation->image) }}" class="lightBoxReaction"
                    data-lightbox="dining-gallery-{{ $recreation->id }}">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </a>
                <a href="#" class="reactionThreeD"><i class="fa-solid fa-cube"></i></a>
                <div class="reaction mt-2"><i class="{{$recreation->icon}}"></i> {{ $recreation->name }}</div>
            </div>
            @endforeach

        </div>
    </div>
</section> -->
<!-- <section style="background-color: #f8f8f8; p-5">
    <div class="container mt-5 pb-5">
        <div class="row">
            <div class="col-md-12 mt-5">
                <a class="diningHeading">Thins To Do</a>
            </div>
        </div>
        <div class="row reactionPhoto">
            <div class="col-md-4 reactionItem">
                <div class="image-container">
                    <img style="width: 100%;" src="{{asset('/')}}assets/web/images/virtual1.jpg" alt="">
                    <div class="reaction-overlay"></div>
                </div>
            </div>

            <div class="col-md-4 reactionItem">
                <div class="image-container">
                    <img style="width: 100%;" src="{{asset('/')}}assets/web/images/virtual2.jpg" alt="">
                    <div class="reaction-overlay"></div>
                </div>
            </div>


            <div class="col-md-4 reactionItem">
                <div class="image-container">
                    <img style="width: 100%;" src="{{asset('/')}}assets/web/images/virtual3.jpg" alt="">
                    <div class="reaction-overlay"></div>
                </div>
            </div>
            <div class="col-md-4 reactionItem">
                <div class="image-container">
                    <img style="width: 100%;" src="{{asset('/')}}assets/web/images/virtual4.jpg" alt="">
                    <div class="reaction-overlay"></div>
                </div>
            </div>

            <div class="col-md-4 reactionItem">
                <div class="image-container">
                    <img style="width: 100%;" src="{{asset('/')}}assets/web/images/virtual5.jpg" alt="">
                    <div class="reaction-overlay"></div>
                </div>
            </div>

            <div class="col-md-4 reactionItem">
                <div class="image-container">
                    <img style="width: 100%;" src="{{asset('/')}}assets/web/images/virtual6.jpg" alt="">
                    <div class="reaction-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</section> -->

@endsection