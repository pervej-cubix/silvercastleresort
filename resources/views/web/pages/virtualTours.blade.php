@extends('web.main')

@section('content')


<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Virtual Tours</a>
            </div>
        </div>

        <section style="background-color: #F4FFF7; p-5">
            <div class="container mt-5 pb-5">
                <div class="row">
                    @foreach($virtual_tours as $virtual_tour)
                    <div class="col-md-4 reactionItem">
                        <div class="image-container">
                            <a href="{{$virtual_tour->link}}" target="_blank">
                                <img style="width: 100%;" src="{{asset($virtual_tour->image)}}" alt="">
                                <div class="virtual-overlay"><img src="{{asset('/')}}assets/web/images/360.webp" style="width: 120px;" alt=""></div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>


    </div>
</section>

@endsection