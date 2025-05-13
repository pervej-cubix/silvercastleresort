@extends('web.main')

@section('content')

<style>
html,
body {
    overflow-x: hidden;
    background-color: #f8f8f8;
}
</style>

<!-- About us section -->
<section id="diningSection" style="padding-top: 25px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="diningHeading">Accommodation</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 m-auto">
                <p style="text-align: justify;">Silvercastle offers a refined blend of comfort, luxury, and
                    convenience for all types of travelers. From well-appointed Deluxe Rooms to spacious Executive
                    Suites, each accommodation is thoughtfully designed with modern amenities and tasteful interiors.
                    Whether you're visiting for business or leisure, guests can enjoy personalized service, a relaxing
                    atmosphere, and a prime location close to major attractions. With scenic views, cozy ambiance, and
                    exceptional hospitality, Silvercastle is the perfect destination for a memorable stay</p>
            </div>
        </div>

    </div>
</section>

<section style="margin-top: 100px;">
    <div class="container mt-5 mb-5">
        <div class="row accummodationBody">
            @foreach ($accommodations as $accomodation)
            <div class="itemAccummo col-md-6 fade-in" style="animation-duration: 1.5s; animation-delay: 0.5s;"
                data-animation="{{ $loop->iteration % 2 == 1 ? 'fadeInLeft' : 'fadeInRight' }}">

                <!-- Thumbnail Image -->
                <div class="accomodation-img-box">
                    <a href="{{ route('roomDetails', $accomodation->slug) }}" class="acomo">
                        <img class="zoom-out" style="object-fit: cover;" src="{{ asset($accomodation->image) }}" alt="">
                    </a>
                </div>
                <div class="accommodationCard" style="animation-duration: 1.5s; animation-delay: 0.5s;"
                    data-animation="{{ $loop->iteration % 2 == 1 ? 'fadeInLeft' : 'fadeInRight' }}">
                    <h3>
                        {{ $accomodation->roomType }}
                        <a href="{{ route('roomDetails', $accomodation->slug) }}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </h3>
                    <p>Room Type: Grand King</p>
                    <p>Size: {{ $accomodation->roomSize }} | No of rooms: {{ $accomodation->noRoom }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section>
    <div class="container facility mt-4">
        <div class="row ">
            <div class="col-md-12">
                <h2 class="m-4 text-center">Facilities</h2>
            </div>
        </div>
        <div class="row facilityBody ">
            <div class="col-md-4">
                <div class="accumutionItme">
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i>
                        Air Conditioning
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i>
                        Free hi-speed internet
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i>
                        24 hrs tea/coffee
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i>
                        connection channel
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i>
                        Telephone
                    </li>
                    <li> <i class="fa-solid fa-check facilityIcon"></i> Minibar</li>
                </div>
            </div>
            <div class="col-md-4">
                <div class="accumutionItme">
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> Hot & cold water
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> Hair dryer
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> 24 Hours Front Desk
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> 24 hours electricity backup including AC
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> Breakfast for two persons
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> Room Service
                    </li>
                </div>
            </div>
            <div class="col-md-4">
                <div class="accumutionItme">
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i>
                        Laundry Facilities
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i>
                        Swimming Pool
                    </li>
                    <!-- <li>                              
                            <i class="fa-solid fa-check facilityIcon"></i> Jacuzzi
                        </li> -->
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> GYM
                    </li>
                    <li>
                        <i class="fa-solid fa-check facilityIcon"></i> Car Parking
                    </li>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h4 style="color:#6EC1E4">Terms & Conditions</h4>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="terms-condition">
                    <p><i class="fa-regular fa-square-check conditonItem"></i> All rates are subject to 10% Service
                        Charge and 15% VAT.</p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> Pets and outside foods are strictly
                        prohibited.
                    </p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> All rates are subject to 10% Service
                        Charge and 15% VAT.</p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> NID for Bangladeshi Nationals and
                        Passport for Foreigners is a MUST at the time of Check-In.
                    </p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i>The Reservation & Cancellation policy will
                        be applicable as per Sarah Resort's policy.</p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> In case of smoking in a non-smoking room,
                        a surcharge of BDT. 2000/= will be applied upon check out.
                    </p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> All rates are subject to 10% Service
                        Charge and 15% VAT.</p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> The above rates include complimentary
                        breakfast for two (2) persons per room. Additional breakfast will be charged at applicable
                        rates.
                    </p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> All rates are subject to 10% Service
                        Charge and 15% VAT.</p>
                    <p><i class="fa-regular fa-square-check conditonItem"></i> The above rates include complimentary
                        breakfast for two (2) persons per room. Additional breakfast will be charged at applicable
                        rates.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection