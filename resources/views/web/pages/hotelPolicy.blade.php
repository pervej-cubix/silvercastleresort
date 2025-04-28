@extends('web.main')

@section('content')

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-4">Hotel Policy</h1>
        <p class="lead">Please take a moment to familiarize yourself with our hotel policies to ensure a comfortable stay.</p>
    </div>

    <!-- Cover Image -->
    <div class="mb-4 text-center">
        <div class="mb-3">
            <i class="fas fa-hotel fa-5x text-primary"></i> {{-- You can change the icon as needed --}}
        </div>
        {{-- <img src="{{ asset('images/hotel-policy-banner.jpg') }}" class="img-fluid rounded shadow" alt="Hotel Policy"> --}}
    </div>    

    <!-- Check-in/Check-out Policy -->
    <div class="mb-5">
        <h3 class="mb-3">Check-In / Check-Out</h3>
        <ul>
            <li>Check-in time is from <strong>2:00 PM</strong></li>
            <li>Check-out time is by <strong>12:00 PM</strong></li>
            <li>Early check-in or late check-out may be available upon request (charges may apply)</li>
        </ul>
    </div>

    <!-- Cancellation Policy -->
    <div class="mb-5">
        <h3 class="mb-3">Cancellation Policy</h3>
        <p>
            Reservations can be cancelled free of charge up to <strong>48 hours</strong> prior to arrival. For late cancellations or no-shows, one night’s charge will apply.
        </p>
    </div>

    <!-- Payment Policy -->
    <div class="mb-5">
        <h3 class="mb-3">Payment Methods</h3>
        <p>
            We accept the following payment methods:
        </p>
        <ul>
            <li>Credit/Debit Cards (Visa, Mastercard, Amex)</li>
            <li>Mobile Payments (bKash, Nagad)</li>
            <li>Cash (in BDT only)</li>
        </ul>
    </div>

    <!-- Smoking Policy -->
    <div class="mb-5">
        <h3 class="mb-3">Smoking Policy</h3>
        <p>
            Our hotel maintains a <strong>strict non-smoking policy</strong> in all rooms and public areas. A cleaning fee of <strong>৳5,000</strong> will be charged for violations.
        </p>
    </div>

    <!-- Pet Policy -->
    <div class="mb-5">
        <h3 class="mb-3">Pet Policy</h3>
        <p>
            Unfortunately, pets are not allowed in the hotel premises. Exceptions may apply for service animals with proper documentation.
        </p>
    </div>

    <!-- Guest Responsibility -->
    <div class="mb-5">
        <h3 class="mb-3">Guest Responsibilities</h3>
        <ul>
            <li>Guests are responsible for any damage caused to hotel property during their stay.</li>
            <li>Guests must present valid government-issued ID at check-in.</li>
        </ul>
    </div>

    <!-- Footer Note -->
    <div class="alert alert-info">
        If you have any questions regarding our policies, please feel free to contact our front desk at <strong>+880 17 0070 7724</strong> or email us at <strong>reservation@hotelgrace21.com</strong>.
    </div>
</div>

@endsection
