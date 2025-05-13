@extends('web.main')

@section('content')


<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Meetings & Events</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 m-auto">
                    <h3>Corporate Point</h3>
                    <p style="text-align: justify;">
                        The Hotel has two Food and Beverage outlets and small meeting area branded as Corporate Point. On top of that there is a function area at the roof-top where we can accommodate around 20-25 people in different table set up for Dinner or for any other events.</p>
            </div>
        </div>
    </div>
</section>
<section id="Speacitial-feature">
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-12 text-center m-4">
                <h3>Special Features</h3>
            </div>
        </div>
        <div class="row pb-4 justify-content-between align-items-center">
            <div class="col-md-4 text-center border py-3">
                <h5>Capacity</h5>
                <h6>1000</h6>
            </div>
            <div class="col-md-4 text-center py-4">
                <a href="{{ route('booking-query') }}" class="btn btn-primary btn-lg px-4 shadow rounded-pill">
                     Booking Query <i class="fas fa-arrow-right me-2"></i>
                </a>
            </div>
            <div class="col-md-4 text-center border py-3">
                <h5>Book Your Table</h5>
                <h6>+88 01810 035 005</h6>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-5">
        @foreach ($meetings as $meeting)
        <div class="row mb-4">
            <div class="col-md-6 animate__animated animate__fadeInLeftBig"
                style="animation-duration: 1.5s; animation-delay: 0.5s;">
                <!-- Thumbnail Image -->
                <a href="{{ asset($meeting->image) }}" data-lightbox="{{$meeting->meetingName}}">
                    <img class="zoom-out top-image" style="width: 100%; height: 400px;"
                        src="{{ asset($meeting->image) }}" alt="">
                </a>

                <!-- Lightbox Trigger (Optional Icon Links) -->
                <a href="{{ asset($meeting->image) }}" class="lightBox" data-lightbox="{{$meeting->meetingName}}">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </a>
                <a href="#" class="threeD"><i class="fa-solid fa-cube"></i></a>

                @if($meeting->meeting_gallaries && count($meeting->meeting_gallaries) > 0)
                @foreach($meeting->meeting_gallaries as $meeting_gallaray)
                <a href="{{ asset($meeting_gallaray->meeting_photo) }}" data-lightbox="{{$meeting->meetingName}}"
                    style="display: none; width: 100%;"></a>
                @endforeach
                @else
                <p>No Galleries Available</p>
                @endif

            </div>

            <div class="col-md-6 pl-5 back animate__animated animate__fadeInRightBig"
                style="animation-duration: 1.5s; animation-delay: 0.5s;"">
                    <h3 class=" diningHeading mt-3">{{$meeting->meetingName}}</h3>
                <p class="mt-3" style="text-align: justify;">{{$meeting->description}}</p>
                <h5 class="mt-3" style="color:#6EC1E4"><i class="fa-solid fa-gift"></i> Features</h5>
                @if ($meeting->Features1)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$meeting->Features1}}
                </li>
                @endif
                @if ($meeting->Features2)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$meeting->Features2}}
                </li>
                @endif
                @if ($meeting->Features3)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$meeting->Features3}}
                </li>
                @endif
                @if ($meeting->Features4)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$meeting->Features4}}
                </li>
                @endif
                @if ($meeting->Features5)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$meeting->Features5}}
                </li>
                @endif
                @if ($meeting->Features6)
                <li class="clubItem"><i style="color:#6EC1E4" class="fa-solid fa-check foo"></i>{{$meeting->Features6}}
                </li>
                @endif
            </div>
        </div>

    </div>
    @endforeach
</section>


@endsection