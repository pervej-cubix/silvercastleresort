@extends('web.main')

@section('content')


<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Photo Gallery</a>
            </div>
        </div>

        <section style="  margin-top: 50px;">
            <div class="container  pb-5">
                <div class="row reactionPhoto">
                    @foreach($gallery_photos as $gallery_photo)
                    <div class="col-md-4 reactionItem">
                        <div class="PhotoImage-container">
                            <a href="{{asset($gallery_photo->image)}}" data-lightbox="gallery" data-title="Your Caption Here">
                                <img style="width: 100%;" src="{{asset($gallery_photo->image)}}" alt="">
                                <div class="photo-overlay"><i class="fa-thin fa-plus"></i></div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                    <!-- <div class="col-md-4 reactionItem">
                        <div class="PhotoImage-container">
                            <a href="{{asset('/')}}assets/web/images/reaction4.jpg" data-lightbox="gallery" data-title="Your Caption Here">
                                <img style="width: 100%;" src="{{asset('/')}}assets/web/images/reaction6.jpg" alt="">
                                <div class="photo-overlay"><i class="fa-thin fa-plus"></i></div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 reactionItem">
                        <div class="PhotoImage-container">
                            <a href="{{asset('/')}}assets/web/images/reaction5.jpg" data-lightbox="gallery" data-title="Your Caption Here">
                                <img style="width: 100%;" src="{{asset('/')}}assets/web/images/reaction3.jpg" alt="">
                                <div class="photo-overlay"><i class="fa-thin fa-plus"></i></div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 reactionItem">
                        <div class="PhotoImage-container">
                            <a href="{{asset('/')}}assets/web/images/reaction6.jpg" data-lightbox="gallery" data-title="Your Caption Here">
                                <img style="width: 100%;" src="{{asset('/')}}assets/web/images/reaction4.jpg" alt="">
                                <div class="photo-overlay"><i class="fa-thin fa-plus"></i></div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 reactionItem">
                        <div class="PhotoImage-container">
                            <a href="{{asset('/')}}assets/web/images/reaction7.jpg" data-lightbox="gallery" data-title="Your Caption Here">
                                <img style="width: 100%;" src="{{asset('/')}}assets/web/images/reaction5.jpg" alt="">
                                <div class="photo-overlay"><i class="fa-thin fa-plus"></i></div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 reactionItem">
                        <div class="PhotoImage-container">
                            <a href="{{asset('/')}}assets/web/images/reaction8.jpg" data-lightbox="gallery" data-title="Your Caption Here">
                                <img style="width: 100%;" src="{{asset('/')}}assets/web/images/reaction6.jpg" alt="">
                                <div class="photo-overlay"><i class="fa-thin fa-plus"></i></div>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>



    </div>
</section>


@endsection