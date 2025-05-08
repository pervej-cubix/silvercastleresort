@extends('web.main')

@section('content')

<style>
.price-row {
    display: flex;
    justify-content: space-between;
    text-align: center;
    align-items: center;
    width: 100%;
}

.price-row h3 {
    font-size: 19px !important;
}

.discount-section {
    text-align: center;

}

.discount-section h3 {
    font-size: 14px !important;
}

.discount-section h5 {
    font-size: 15px !important;
}
</style>

<section id="diningSection" style="padding-top: 150px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">{{$accommodation->roomType}}</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 m-auto">
                <p style="text-align: justify;">
                    {{$accommodation->description}}
                </p>

            </div>
        </div>

    </div>
</section>
<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if($accommodation->accommodation_gallaries->isNotEmpty())
                        @foreach($accommodation->accommodation_gallaries as $gallery)
                        <div class="carousel-item active" data-bs-interval="2000" style="height: 90vh;">
                            <img src="{{ asset($gallery->accommodation_photo) }}"
                                class="d-block w-100 zoom-img gallery-img" alt="...">
                        </div>
                        @endforeach 
                        @endif
                    </div>                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
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
        <div class="row pb-5 gy-4">
            <div class="col-md-2 text-center">
                <h6>Room Type</h6>
                <h6 class="roomdetails">{{$accommodation->roomType}}</h6>
            </div>

            <div class="col-md-2 text-center">
                <h6>Room Size</h6>
                <h6 class="roomdetails">{{$accommodation->roomSize}}</h6>

            </div>
            <div class="col-md-2  text-center">
                <h6>No of Room</h6>
                <h6 class="roomdetails">{{$accommodation->noRoom}}</h6>
            </div>
            <div class="col-md-2 text-center">
                <h6>Occupancy</h6>
                <h6 class="roomdetails">{{$accommodation->occupancy}} pax
                </h6>
            </div>
            {{-- <div class="col-md-2 text-center">
                    <h6>Room Rake Rate</h6>
                    <h6 class="roomdetails">BDT {{$accommodation->rackRate}}++</h6>
            </div> --}}
            <div class="col-md-2 text-center">
                @php
                    $rackRate = $accommodation->rackRate;
                    $discountedRate = $accommodation->discountedRate;
                    $exchangeRate = 0.0091; // Example: 1 BDT = 0.0091 USDT
                    $usdRackRate = round($rackRate * $exchangeRate, 2);
                    $usdDiscountedRate = round($discountedRate * $exchangeRate, 2);
                @endphp
            
                <h6>Room Rack Rate</h6>
            
                <div class="price-row">
                    @if ($discountedRate > 0)
                        {{-- Rack rate with line-through --}}
                        <h3 style="font-size: 16px;">
                            <span style="text-decoration: line-through;">{{ $usdRackRate }}</span>
                            <span style="font-size: 15px; font-weight: 600;">&nbsp;USD</span>
                        </h3>
                        <h3 style="font-size: 16px;">
                            <span style="text-decoration: line-through;">{{ $rackRate }}</span>
                            <span style="font-size: 15px; font-weight: 600;">&nbsp;BDT</span>
                        </h3>
                    @else
                        {{-- Rack rate normally --}}
                        <h3 style="font-size: 16px;">
                            {{ $usdRackRate }}
                            <span style="font-size: 15px; font-weight: 600;">USD</span>
                        </h3>
                        <h3 style="font-size: 16px;">
                            {{ $rackRate }}
                            <span style="font-size: 15px; font-weight: 600;">BDT</span>
                        </h3>
                    @endif
                </div>
            
                <h6>After Discount</h6>
            
                <div class="price-row justify-content-center gap-2">
                    @if ($discountedRate > 0)
                        {{-- Show discounted price --}}
                        <h3>{{ $usdDiscountedRate }}
                            <span style="font-size: 16px; font-weight: 600;">USD</span>
                        </h3>
                        <h3>{{ $discountedRate }}
                            <span style="font-size: 16px; font-weight: 600;">BDT</span>
                        </h3>
                    @else
                        <h6 class="text-center"><strong>Not Available</strong></h6>
                    @endif
                </div>
            </div>
            
            <div class="col-md-2 text-center">
                <a href="{{route('bookNow')}}" class="btn btn-primary btn_de text-center">Book Now</a>
                <div class="col-md-12 text-end mt-3">
                    <p style="font-size: 14px;">(10% SC & 15% VAT will be Added)</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="roomService">Amenities of The Water Lodge</h4>
            </div>
        </div>
    </div>
</section>
<section style="margin-top: 100px; margin-bottom: 100px;">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12 m-auto ">
                <div class="roomServiceItem ">
                    <div class="itme1 text-center">
                        <i class="fa-solid fa-wifi roomServiceItemIcon"></i>
                        <p>Free hi-speed internet</p>
                    </div>

                    <div class="itme1 text-center">
                        <i class="fa-solid fa-mug-hot roomServiceItemIcon"></i>
                        <p>24hrs tea/coffee</p>
                    </div>


                    <div class="itme1 text-center">
                        <i class="fa-solid fa-bread-slice roomServiceItemIcon"></i>
                        <p>Breakfast for two person</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection