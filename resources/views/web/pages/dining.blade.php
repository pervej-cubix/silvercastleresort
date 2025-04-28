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
<section id="Speacitial-feature">
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-12 text-center mt-4 mb-4">
                <h3>Special Features</h3>
            </div>
        </div>
        <div class="row pb-5 ">
            <div class="col-md-4 text-center">
                <h6>No of Dining Space</h6>
                <h6>05</h6>
            </div>

            <div class="col-md-4 text-center">
                <h6>Capacity</h6>
                <h6>1000</h6>

            </div>
            <div class="col-md-4  text-center">
                <h6>Book Your Table</h6>
                <h6>+8801700707724</h6>
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

                <!-- Lightbox Trigger (Optional Icon Links) -->
                <div>
                    <a href="{{ asset($dining->image) }}" class="lightBox" data-lightbox="{{$dining->diningName}}">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </a>
                    <a href="#" class="threeD"><i class="fa-solid fa-cube"></i></a>
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