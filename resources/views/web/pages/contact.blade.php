@extends('web.main')

@section('content')


<section id="diningSection" style="padding-top: 17px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<section id="Speacitial-feature">
    <div class="container mt-5 p-3 text-center ">
        <div class="row ">
            @foreach($addresses as $address)
            <div class="col-md-3 text-center">
                <div class="contactIcon"><i class="{{$address->icon}}"></i></div>
                <div class="contactHeading">{{$address->title}}</div>
                <p class="contactDescription">{{$address->address}}</p>
            </div>
            @endforeach
</section>
<section>
    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-md-5 m-auto">
                <p class="formHeading">
                    We give high priority to our customers inquiry. Let us know how can we help you. Write us below.
                </p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7 m-auto">
            <form action="{{ route('contactMail') }}" method="POST">
                @csrf  <!-- Required for security in Laravel -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" name="first_name" class="form-control formField" placeholder="Enter your first name">
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control formField" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" name="last_name" class="form-control formField" placeholder="Enter your last name">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control formField" placeholder="Enter your phone number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control formField" placeholder="Enter your subject">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <textarea name="comments" class="form-control" rows="8" placeholder="Enter your comments"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-outline-secondary w-100 formBtn">
                            <i class="fa-solid fa-location-arrow"></i> SEND
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
</section>


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