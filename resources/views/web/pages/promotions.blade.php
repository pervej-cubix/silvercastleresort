@extends('web.main')

@section('content')


<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Promotions</a>
            </div>
        </div>
    </div>
</section>

<!-- Promotions offer -->
<section>
    <div class="container mt-5">
        <div class="row">
            @foreach($promotions as $promotion)
            <div class="col-md-6 text-center mb-4 fade-in"
                data-animation="{{ $loop->iteration % 2 == 1 ? 'fadeInLeft' : 'fadeInRight' }}">
                <img class="zoom-out" src="{{ asset($promotion->image) }}" style="width: 100%; height: 550px;"
                    alt="Promotion Image">
            </div>
            @endforeach
        </div>
        <!-- <div class="row">
                <div class="col-md-12 mt-3">
                    <span> Hotline: 013325562-81 </span> <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">More Details</button>
                </div>
            </div> -->
    </div>
</section>

<!-- Speacitial offer -->
@if($special)
<section id="target-section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-4">
                <a class="diningHeading">Special Offers</a>
            </div>
            <div class="col-md-6 offset-md-3 text-center fade-in" data-animation="fadeInLeft">
                <img class="zoom-out" src="{{ asset($special->image) }}" style="width: 100%; height: 550px;" alt="">
            </div>
        </div>
        <!-- <div class="row">
                <div class="col-md-12 mt-3">
                    <span> Hotline: 013325562-81 </span> <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">More Details</button>
                </div>
            </div> -->
    </div>
</section>
@endif

<section>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <iframe src="{{$social_link->map_link}}" width="100%" height="450" style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>


@endsection