@extends('web.main')

@section('content')


<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Silvercastle Stars</a>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-6  m-4 p-5" style="background: #F4FFF7;">
                <div class="loyaltyItem">
                    <a class="diningHeading" style="    color: #09203b; font-size: 25px;font-weight: 600;">
                        {{$with_title->title}}:</a>
                    <h5 class="mt-3 loyaltyServiceHeading"> <i class="fa-brands fa-servicestack"></i>
                        {{$with_title->second_title}}:</h5>
                    <?php
                    $items = explode(',', $with_title->description);
                    foreach ($items as $list):
                    ?>
                    <li><i class="<?= $with_title->icon ? $with_title->icon : 'fa-solid fa-check' ?>"></i> <span
                            style="margin-left: 20px;"> {{$list}}.</span></li>
                    <?php endforeach ?>

                    <!-- <li><i class="fa-solid fa-check"></i> <span style="margin-left: 20px;"> 8 Nights stay on Weekdays for 2 per persons except blackout dates & public.</span></li>
                    <li><i class="fa-solid fa-check"></i> <span style="margin-left: 20px;"> 8 Nights stay on Weekdays for 2 per persons except blackout dates & public.</span></li>
                    <li><i class="fa-solid fa-check"></i> <span style="margin-left: 20px;"> 8 Nights stay on Weekdays for 2 per persons except blackout dates & public.</span></li>
                    <li><i class="fa-solid fa-check"></i> <span style="margin-left: 20px;"> 8 Nights stay on Weekdays for 2 per persons except blackout dates & public.</span></li>
                    <li><i class="fa-solid fa-check"></i> <span style="margin-left: 20px;"> 8 Nights stay on Weekdays for 2 per persons except blackout dates & public.</span></li>
                    <li><i class="fa-solid fa-check"></i> <span style="margin-left: 20px;"> 8 Nights stay on Weekdays for 2 per persons except blackout dates & public.</span></li> -->
                </div>
                @foreach($without_title as $data)
                <div class="loyaltyItem">
                    <h5 class="mt-3 loyaltyServiceHeading"> <i class="fa-brands fa-servicestack"></i>
                        {{$data->second_title}}:</h5>
                    <?php
                    $items = explode(',', $data->description);
                    ?>
                    @foreach($items as $list)
                    <li><i class="<?= $data->icon ? $data->icon : 'fa-solid fa-check' ?>"></i> <span
                            style="margin-left: 20px;"> {{$list}}.</span></li>
                    @endforeach
                    <!-- <li><i class="fa-solid fa-check"></i> <span style="margin-left: 20px;"> 8 Nights stay on Weekdays for 2 per persons except blackout dates & public.</span></li> -->
                </div>
                @endforeach
            </div>
            <div class="col-md-5">
                @foreach($images as $image)
                <div class="loyaltyImg">
                    <img src="{{asset($image->image)}}" style="width: 100%;" alt="">
                </div>
                @endforeach
                <!-- <div class="loyaltyImg mt-4">
                    <img src="{{asset('/')}}assets/web/images/slide1.jpg" style="width: 100%;" alt="">
                </div> -->
            </div>

        </div>
    </div>
</section>

@endsection