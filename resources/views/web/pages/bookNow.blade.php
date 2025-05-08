@extends('web.main')
@section('content')
@include('sweetalert::alert')
@yield('scripts')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    .card-title {
    font-size: 1.25rem;
    font-weight: 600;
    }

    .card-text {
        font-size: 0.95rem;
    }

    @media(max-width: 1200px){
      .room-type-content p{
        font-size: 16px !important;
      }
    }

    .room-form input {
        font-size: 0.9rem;
    }

    .booking-details {
    position: fixed;
    top: 0;
    right: -100%; /* Slide off-screen initially */
    width: 400px;
    height: 100%;
    background-color: #fff;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    transition: right 0.3s ease; /* Slide-in effect */
    padding: 20px;
    z-index: 1000;
}

    /* Show the combined booking details when toggled */
    .booking-details.show {
        right: 0; /* Slide in */
    }

    .form-container {
        padding: 10px;
        overflow-y: auto;
    }

    #confirm-btn {
        margin-top: 20px;
    }

    /* Close button for the panel */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 45%;
        font-size: 18px;
        background: #2c3e50;        
        color: #f5f5f5;
        padding: auto 10px; 
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-weight: 600;
    }

    /* When panel is visible */
    .guest-details-panel.show {
        right: 0;
    }

    /* Styling for inputs and buttons in the panel */
    .guest-details-panel input, .guest-details-panel textarea {
        margin-bottom: 15px;
        width: 100%;
    }

    /* Sliding panel */
.guest-details-panel {
  position: fixed;
  top: 0;
  right: -400px; /* hide initially */
  width: 400px;
  height: 100%;
  background: #fff;
  box-shadow: -2px 0 8px rgba(0,0,0,0.2);
  padding: 20px;
  transition: right 0.3s ease-in-out;
  z-index: 1001;
  overflow-y: auto;
}

.guest-details-panel.show {
  right: 0;
}

/* Fixed Toggle Button */
.toggle-panel-btn {
  position: fixed;
  top: 50%;
  right: 0;
  transform: translateY(-50%);
  z-index: 1002;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 6px 0 0 6px;
  padding: 10px 5px;
  cursor: pointer;
  font-size: 16px;
  width: 5%;
  transition: right 0.3s ease-in-out;
}

.nav-tabs .nav-link {
    width: 100%;
    font-weight: 600;
    font-size: 16px;
    border-radius: 0;
  }

  .nav-tabs .nav-link.active {
    background-color: #0d6efd;
    color: white;
  }

  .nav-tabs {
    border-bottom: 2px solid #dee2e6;
  }

  .tab-pane {
    padding: 20px 0;
  }

</style>

<section style="padding-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-7 text-center m-auto">
                <h3 style="color: #232B37; font-weight: bold;">Book Now</h3>
                <p class="bookNowText">
                    We would like to welcome you to Hotel Grace21. Please fill in the following booking form
                    and
                    send it
                    to us. We will get back to you with confirmation as soon as possible.</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <form action="/reservation-check" method="POST" class="reservation-form">
            <div class="row justify-content-between align-items-center border py-4 px-1">              
              <div class="col-md-6 col-12 form-group">
                <label for="checkin">Check in</label>
                <input type="date" class="form-control formField reservation_formField" 
                       id="checkin" name="checkin" placeholder="Select Date" required>
              </div>
          
              <div class="col-md-6 col-12 form-group">
                <label for="checkout">Check out</label>
                <input type="date" class="form-control formField reservation_formField" 
                       id="checkout" name="checkout" placeholder="Select Date" required>
              </div>
                
            </div>
        </form>
    </div>      
</section>
<section style="margin-top: 100px;">
    <div class="container mt-5 mb-5">
        <div class="row accummodationBody">
            @foreach ($accommodations as $accomodation)
            <div class="itemAccummo col-md-4 col-12 mb-4 fade-in">
        
                <!-- Card Container -->
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">        
                    <!-- Image -->
                    <a href="{{ route('roomDetails', $accomodation->slug) }}">
                        <img src="{{ asset($accomodation->image) }}" 
                             class="card-img-top img-fluid" 
                             style="height: 250px; object-fit: cover;" 
                             alt="{{ $accomodation->roomType }}">
                    </a>        
                    <!-- Card Body -->
                    <div class="card-body room-type-card-body p-4 bg-light">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            {{ $accomodation->roomType }}
                            <a href="{{ route('roomDetails', $accomodation->slug) }}" class="text-decoration-none">
                                <i class="fa-solid fa-arrow-right" style="color: #f56040;"></i>
                            </a>
                        </h5>
                        <div class="d-flex justify-content-between room-type-content">
                            <div>
                                <p class="card-text"><strong>Room Type:</strong> Grand King</p>
                                <p class="card-text">
                                    <strong>Size:</strong> {{ $accomodation->roomSize }}
                                    {{-- <strong>Total Room:</strong> {{ $accomodation->noRoom }} --}}
                                </p>
                            </div>
                            <div>
                                <p class="card-text"><strong>Rack Rate:</strong> $<span class="text-decoration-line-through" style="letter-spacing: 1px;">{{$accomodation->rackRate}}</span> </p>
                                <p class="card-text"><strong>After Discount:</strong> $<span style="letter-spacing: 1px;">{{$accomodation->discountedRate}}</span> </p>
                            </div>
                        </div>
        
                        <!-- Add Room Button -->
                        <button  class="btn btn-sm text-white add-room-btn mt-2" type="button" data-target="#roomForm-{{ $loop->index }}" data-roomtype="{{ $accomodation->roomType }}" style="background: #f56040;">
                            Add Room
                        </button>
        
                        <!-- Expandable Form Section -->
                        <div id="roomForm-{{ $loop->index }}" class="mt-3 d-none room-form">
                            <div class="mb-1">
                                <label for="rooms-{{ $loop->index }}" class="form-label">No. of Rooms</label>
                                <select class="form-select room-count-select" name="roomtypes[{{ $loop->index }}][count]" id="rooms-{{ $loop->index }}">
                                  <!-- Dynamically populated -->
                                </select>
                            </div>
                              
                              <!-- Dynamic Guest Input Fields -->
                            <div class="dynamic-guests "></div>
                            
                            <input type="hidden" name="roomtypes[{{ $loop->index }}][type]" value="{{ $accomodation->roomType }}">
        
                            <!-- Confirm Button -->
                            <div class="mt-3">
                                <button type="button" class="btn btn-success confirm-room-btn" data-form-id="roomForm-{{ $loop->index }}">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Sliding Panel for Personal Details -->
      
        <div id="guest-details-panel" class="guest-details-panel">
          <button id="toggle-panel" class="toggle-panel-btn">
            ☰ Details
          </button>
            <button id="close-panel" class="close-btn">&nbsp;&nbsp;X&nbsp;&nbsp;</button>
              <div class="header" id="duration_heading">
                
              </div>

            <div class="show_added_room">

            </div>
            <div class="px-2 pb-2" style="background: #eff0f0;">
              <h5 class="mb-4 text-center" style="background: #34495e; color: white; padding: 5px 2px; border-radius: 3px; font-family:Arial, Helvetica, sans-serif;">Guest Details</h5>

              <ul class="nav nav-tabs " id="guestDetailsTab" role="tablist">
                <li class="nav-item" role="presentation" style="width: 50%;">
                  <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal</button>
                </li>
                <li class="nav-item" role="presentation" style="width: 50%;">
                  <button class="nav-link" id="business-tab" data-bs-toggle="tab" data-bs-target="#business" type="button" role="tab">Business</button>
                </li>
              </ul>
            
              <div class="tab-content" id="guestDetailsTabContent">
              
                <!-- Personal Tab -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                  <form id="personal-form">
                    <div>
                      <label for="personal-full-name" class="form-label">Full Name</label>
                      <input type="text" class="form-control" id="personal-full-name" placeholder="Enter Full Name" required>
                    </div>
                    <div>
                      <label for="personal-email" class="form-label">Email Address</label>
                      <input type="email" class="form-control" id="personal-email" placeholder="Enter Email" required>
                    </div>
                    <div>
                      <label for="personal-phone" class="form-label">Phone Number</label>
                      <input type="text" class="form-control" id="personal-phone" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="mb-2">
                      <label for="personal-country">Country</label>                      
                          <select name="country" class="form-select roomtype-select formField" id="personal-country" required>
                              <option value="Bangladesh" selected>Bangladesh</option>
                              <option value="India">India</option>
                              <option value="Pakistan">Pakistan</option>
                              <option value="Nepal">Nepal</option>
                              <option value="Sri Lanka">Sri Lanka</option>
                              <option value="China">China</option>
                              <option value="Japan">Japan</option>
                              <option value="Malaysia">Malaysia</option>
                              <option value="Thailand">Thailand</option>
                              <option value="Indonesia">Indonesia</option>
                          </select>
                    </div>
                    <div>
                      <label for="personal-address" class="form-label">Address</label>
                      <input type="text" class="form-control" id="personal-address" placeholder="Enter Address" required>
                    </div>
                    <div>
                      <label for="personal-requests" class="form-label">Special Requests</label>
                      <textarea class="form-control" id="personal-requests" placeholder="Enter Special Requests" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Proceed to Book</button>
                  </form>
                </div>
              
                <!-- Business Tab -->
                <div class="tab-pane fade" id="business" role="tabpanel">
                  <form id="business-form">
                    <div>
                      <label for="business-full-name" class="form-label">Full Name</label>
                      <input type="text" class="form-control" id="business-full-name" placeholder="Enter Full Name" required>
                    </div>
                    <div>
                      <label for="company-name" class="form-label">Company Name</label>
                      <input type="text" class="form-control" id="company-name" placeholder="Enter Company Name" required>
                    </div>
                    <div>
                      <label for="business-email" class="form-label">Work Email</label>
                      <input type="email" class="form-control" id="business-email" placeholder="Enter Work Email" required>
                    </div>
                    <div>
                      <label for="business-phone" class="form-label">Phone Number</label>
                      <input type="text" class="form-control" id="business-phone" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="mb-2">
                        <label for="country">Country</label>                      
                        <select name="country" class="form-select roomtype-select formField" id="business-country" required>
                            <option value="Bangladesh" selected>Bangladesh</option>
                            <option value="India">India</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="China">China</option>
                            <option value="Japan">Japan</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Indonesia">Indonesia</option>
                        </select>
                    </div>
                    <div>
                      <label for="business-address" class="form-label">Address</label>
                      <input type="text" class="form-control" id="business-address" placeholder="Enter Address" required>
                    </div>
                    <div>
                      <label for="business-requests" class="form-label">Special Requests</label>
                      <textarea class="form-control" id="business-requests" placeholder="Enter Special Requests" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Proceed to Book</button>
                  </form>
                </div>
              
              </div>
            </div>
            
        </div>        
    </div>
</section>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('assets/web/js/book-now.js') }}"></script>
<script>
  window.reservationCheck = "{{ route('reservation-check') }}";
  window.csrfToken = "{{ csrf_token() }}";
</script>
