@extends('web.main')

@section('content')

<style>
    #testimonialCarousel .carousel-item{
        text-align: center;
        padding: 20px 25px;
        background: linear-gradient(135deg, #f7f7f7, #e2e2e2);
        max-height: 60vh;
    }

    #testimonialCarousel .carousel-item img,
    #testimonialCarousel .carousel-item video{
        height: 80px !important;
        width: 80px !important;

    }
</style>

<!-- About us section -->
@foreach($aboutUs as $item)
    @if($item->status == 1)
        <section>
            <div class="container mt-5">
                <div class="row align-items-center">
                    <h2 class="about-heading-first mt-4"><b>about us</b></h2>
                    <div class="col-md-6 sm-12 lg-3">
                        <h1 class="about-heading mb-4">{{ $item->title }}</h1>
                        <p class="about-paragrape">
                            {{ $item->description }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div style="overflow: hidden; height: 60vh;">
                            <img class="zoom-out" style="width: 100%;" src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach

<!-- What makes reayna different? -->
<section id="different">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="mt-5 hedline underline">What makes Grace21 different?</h3>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row" style="overflow:hidden;">
            <div class="col-md-6 text-center fade-in" data-animation="fadeInLeft">
                <img style="width: 100%;" src="{{asset('/')}}assets/web/media/things-to-do.jpg" alt="">
            </div>
            <div class="col-md-6 desc fade-in" data-animation="fadeInRight">
                <!-- <div class="diffrent-icon"><i class="fa-solid fa-compact-disc"></i></div> -->
                <h3>Things To Do</h3>
                @foreach ($Recreations as $Recreation)
                <li> <i class="fa-solid fa-bullseye diffrentIcon"></i>{{$Recreation->name}}</li>
                @endforeach
                <!-- <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> GYM</li>
                        <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> Recreation Center</li>
                        <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> Boating</li>
                        <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> Golf field</li>
                        <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> Outdoor sports</li>
                        <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> Big field</li> -->
                <!-- <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> VR Games</li>
                        <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> Zip Line</li>
                        <li> <i class="fa-solid fa-bullseye diffrentIcon"></i> ATV Bike</li> -->

                {{-- <div class="mt-3"><a href="{{ route('recreation')}}" class="btn btn-primary btn_de text-center">Read
                        more</a></div> --}}
            </div>
        </div>
    </div>
</section>

<!-- Comfortable Stay -->
<section id="comfortable">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h3 class="hedline underline">Comfortable Stay</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-5">
                <div class="owl-carousel owl-theme">
                    @foreach ($accomodations as $accomodation)
                    <div class="item ">
                        <div class="card boxx border-0 shadow m-2 bg-white p-2 pt-2 text-center">
                            <img src="{{asset($accomodation->image)}}" class="card-img-top profileImg" alt="" style="object-fit: cover;">
                            <h3 class="mt-2">{{$accomodation->roomType}}</h3>
                            <p class="mt-2">{{ Str::limit($accomodation->description, 150, '...') }}</p>
                            <a href="{{route('roomDetails',$accomodation->slug)}}"
                                class="btn btn-primary btn_de text-center">Read more</a>
                        </div>
                    </div>
                    @endforeach
                    <!-- Add more items here as needed -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Carousel -->
{{-- <section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">What Our Clients Say</h2>

        <div class="row g-4 align-items-center">
            <!-- Testimonial Carousel (col-8) -->
            <div class="col-md-8">
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($testimonial as $index => $testimonial)
                            <div class="carousel-item @if($index == 0) active @endif testimonial">
                                
                                <div class="image text-center mb-3">
                                    <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" height="80" width="80" class="rounded-circle">
                                </div>                                
                                    <p class="fst-italic">
                                        <span class="open quote">
                                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        </span>
                                         {{ $testimonial->message }}
                                         <span class="close quote">
                                            <i class="fa fa-quote-right" aria-hidden="true"></i>
                                        </span>
                                        </p>
                                
                                <div class="source text-center">
                                    <span>{{ $testimonial->name }}</span>
                                    @if($testimonial->designation || $testimonial->company)
                                        <br>
                                        <small class="text-muted">
                                            {{ $testimonial->designation }}
                                            @if($testimonial->designation && $testimonial->company) at @endif
                                            {{ $testimonial->company }}
                                        </small>
                                    @endif
                                </div>
                                                  
                            </div>
                        @endforeach
                    </div>                    

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>
            </div>

            <!-- Static Contact Details (col-4) -->
            <div class="col-md-4">
                <div class="p-4 shadow rounded bg-white text-center">
                    <h4 class="fw-bold mb-3">Contact Us</h4>
                    <p class="mb-1"><strong>Phone:</strong> +880 123 456 789</p>
                    <p class="mb-1"><strong>Email:</strong> info@hotelgrace21.com</p>
                    <p class="mb-1"><strong>Address:</strong> Nikunja 2, Dhaka, Bangladesh</p>
                    <p><strong>Website:</strong> <a href="https://www.hotelgrace21.com/" target="_blank">hotelgrace21.com</a></p>
                </div>
            </div>

        </div>
    </div>
</section> --}}

<!-- Speacitial offer -->
@if ($promotions && $promotions->isNotEmpty())
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="hedline underline">Promotional Offer</h3>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            @foreach($promotions as $promotion)
            <div class="col-md-6 pro text-center fade-in"
                data-animation="{{ $loop->iteration % 2 == 1 ? 'fadeInLeft' : 'fadeInRight' }}">
                <a href=""><img class="zoom-out" src="{{ asset($promotion->image) }}" alt=""></a>
            </div>
            @endforeach
            <!-- <div class="col-md-6 pro text-center fade-in" data-animation="fadeInRight">
                <a href=""> <img class="zoom-out" src="{{asset('/')}}assets/web/images/offer1.jpg" alt=""></a>
            </div> -->
        </div>
    </div>
</section>
@endif

<!-- Maps -->
<section class="mt-5">
    <iframe src="{{$social_link->map_link}}" width="100%" height="450" style="border:0;" allowfullscreen=""
        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

@endsection

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/680a2cf7dbea0a190de1865f/1ipjrva5m';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
