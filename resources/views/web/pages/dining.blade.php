@extends('web.main')

@section('content')

<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Dining</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 m-auto">
                <p style="text-align: justify;">Hotel Grace21 features a variety of dining options that cater to
                    diverse tastes and preferences, making it a culinary haven for guests. The resort boasts three
                    distinct restaurants: Cafe the Arko, Lobby Cafe, and Roof Top Cafe. <br>

                    Cafe the Arko offers a relaxed atmosphere with a diverse menu that includes local and international
                    dishes, perfect for any meal of the day. Known for its freshly brewed coffee and delectable
                    pastries, this cafe provides a cozy setting for casual dining and social gatherings.<br>

                    Lobby Cafe, characterized by its warm ambiance, is ideal for light meals and snacks. Guests can
                    enjoy a range of beverages and quick bites, making it a convenient spot to unwind or catch up with
                    friends.<br>

                    In contrast, the Roof Top Cafe elevates the dining experience with breathtaking views of the
                    resort's lush surroundings. This cafe specializes in gourmet dishes that highlight local
                    ingredients, creating an elegant setting for romantic dinners or special occasions. The combination
                    of exquisite food and stunning vistas makes it a favorite among guests.</p>
            </div>
        </div>

    </div>
</section>
<section id="Special-feature">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center mt-4 mb-5">
                <h3 class="fw-bold">Special Features</h3>
            </div>
        </div>
        <div class="row justify-content-center pb-5 gx-4 gy-4">
            <div class="col-md-4">
                <div class="feature-card text-center p-4 shadow-sm rounded-4 h-100">
                    <h6 class="text-muted">No of Dining Space</h6>
                    <h4 class="fw-semibold counter" data-count="5">05</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card text-center p-4 shadow-sm rounded-4 h-100">
                    <h6 class="text-muted">Capacity</h6>
                    <h4 class="fw-semibold counter" data-count="1000">1000</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card text-center p-4 shadow-sm rounded-4 h-100">
                    <h6 class="text-muted">Book Your Table</h6>
                    <h4 class="fw-semibold" style="color: #f56040;">+8801700707724</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-5">
        @foreach ($dininges as $dining)
        <div class="row mt-5">
            <div class="col-md-6 animate__animated animate__fadeInLeftBig"
                style="animation-duration: 1.5s; animation-delay: 0.5s;">
                <!-- Thumbnail Image -->
                <div style="height: 450px; overflow: hidden;">
                    <a href="{{ asset($dining->image) }}" data-lightbox="{{$dining->diningName}}">
                        <img class="zoom-out top-image" height="100%" style="width: 100%;" src="{{ asset($dining->image) }}" alt="">
                    </a>
                </div>

                <!-- Hidden Images for Lightbox -->
                @if($dining->dining_gallaries && count($dining->dining_gallaries) > 0)
                @foreach($dining->dining_gallaries as $dining_gallaray)
                <a href="{{ asset($dining_gallaray->dining_photo) }}" data-lightbox="{{$dining->diningName}}"
                    style="display: none; width: 100%;"></a>
                @endforeach
                @else
                <p>No Galleries Available</p>
                @endif
            </div>

            <div class="col-md-6 pl-5 animate__animated animate__fadeInRightBig"
                style="animation-duration: 1.5s; animation-delay: 0.5s;">
                    <h3 class=" diningHeading mt-3">{{$dining->diningName}}</h3>
                <p class="mt-3" style="text-align: justify;">{{$dining->description}}</p>
                <h5 class="mt-3" style="color:#6EC1E4"><i class="fa-solid fa-gift"></i> Features</h5>
                @if ($dining->Features1)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$dining->Features1}}
                </li>
                @endif
                @if ($dining->Features2)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$dining->Features2}}
                </li>
                @endif
                @if ($dining->Features3)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$dining->Features3}}
                </li>
                @endif
                @if ($dining->Features4)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$dining->Features4}}
                </li>
                @endif
                @if ($dining->Features5)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$dining->Features5}}
                </li>
                @endif
                @if ($dining->Features6)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$dining->Features6}}
                </li>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection

<script>
    function animateCounter(element, target, duration = 3000) {
        let start = 0;
        let startTime = null;
        const isPhone = String(target).startsWith("+");

        function updateCounter(currentTime) {
            if (!startTime) startTime = currentTime;
            const progress = Math.min((currentTime - startTime) / duration, 1);
            const current = Math.floor(progress * target);
            element.textContent = isPhone ? target : current;

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        }

        requestAnimationFrame(updateCounter);
    }

    window.addEventListener("load", () => {
        const counters = document.querySelectorAll(".counter");
        counters.forEach(counter => {
            const target = counter.getAttribute("data-count");
            const isNumber = /^\d+$/.test(target);
            animateCounter(counter, isNumber ? parseInt(target) : target);
        });
    });
</script>