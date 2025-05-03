@extends('web.main')
@section('content')
@include('sweetalert::alert')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9 m-auto">
                <!-- @if (session('messages'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ strip_tags(session('messages')) }}</li>
                    </ul>
                </div>
                @endif -->
                <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ strip_tags($error) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->

                <div style="padding-bottom: 10px; text-align: center;" class="alert d-none" id="availability-result">
                </div>

                <!-- <form action="{{ url(path: '/reservation') }}" method="POST"> -->
                <form id="reservationForm">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="datepicker">Check in</label>
                                <input type="date" class="form-control formField reservation_formField" id="checkin"
                                    name="checkin" placeholder="Select Date" required>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="roomtype">Room Type</label>
                                <select name="roomtype" class="form-select formField " id="roomtype" required>
                                    <option value="">-- Select --</option>
                                    <option value="Deluxe Single">
                                        Deluxe Single
                                    </option>
                                    <option value="Super Deluxe">
                                        Deluxe Double
                                    </option>
                                    <option value="Super Deluxe">
                                        Super Deluxe
                                    </option>
                                    <option value="Super Deluxe">
                                        Super Deluxe (Twin)
                                    </option>
                                    <option value="Super Deluxe">
                                        Family Suit (Triple)
                                    </option>
                                </select>
                            </div> --}}
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <!-- check out -->
                            <div class="mb-3">
                                <label for="checkout">Check out</label>
                                    <input type="date" class="form-control formField reservation_formField" name="checkout"
                                    id="checkout" placeholder="Select Date" required>
                            </div>                            
                            {{-- <div class="mb-3">
                                <label for="roomtype">No Of Rooms</label>
                                <select name="noOf_room" class="form-select formField " id="roomtype" required>
                                    <option value="">-- Select --</option>
                                    <option value="1">
                                        1
                                    </option>
                                    <option value="2">
                                        2
                                    </option>
                                    <option value="3">
                                        3
                                    </option>
                                    <option value="4">
                                        4
                                    </option>
                                    <option value="5">
                                        5
                                    </option>
                                </select>
                            </div> --}}
                        </div>

                        <div id="roomTypeContainer">
                            <div class="row"> 
                                <div class="col-md-6">
                                    <label>Room Type</label>
                                    <select name="roomtypes[0][type]" class="form-select formField" required>
                                        <option value="">-- Select --</option>
                                        <option value="Deluxe Single">Deluxe Single</option>
                                        <option value="Deluxe Double">Deluxe Double</option>
                                        <option value="Super Deluxe">Super Deluxe</option>
                                        <option value="Super Deluxe (Twin)">Super Deluxe (Twin)</option>
                                        <option value="Family Suit (Triple)">Family Suit (Triple)</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label>No of Rooms</label>
                                    <select name="roomtypes[0][count]" class="form-select formField" required>
                                        <option value="">-- Select --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-1">
                                    <button type="button" class="btn pb-2 w-100 btn-success" onclick="addRoomType()"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="adult_no">No. of Adults</label>
                                <input type="number" class="form-control formField reservation_formField"
                                    name="adult_no" id="adult_no" placeholder="Enter your No. of Adults" max="10" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- check out -->
                            <div class="mb-3">
                                <label for="child_no">No. of Children</label>
                                <input type="number" class="form-control formField reservation_formField"
                                    name="child_no" id="child_no" max="10" placeholder="No. of Children">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="country">Country</label>
                      
                            <select name="country" class="form-select roomtype-select formField" id="country" required>
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
                        <div class="mb-3 col-md-2">
                            <label for="title">Title</label>
                            <select name="title" data-input-type="select" id="fo_res_title"
                                class="form-control reservation-data form-select formField"
                                style="font-size: 15px; padding: auto 5px;">
                                <option value=""> Select </option>
                                <option value="MR.">MR.</option>
                                <option value="MRS.">MRS.</option>
                                <option value="MS">MS.</option>
                                <option value="MR.">MR. &amp; MRS.</option>
                                <option value="DR.">DR.</option>
                                <option value="NOT APPLICABLE">NOT APPLICABLE</option>
                                <option value="MR. MRS.">MR. MRS.</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control formField reservation_formField"
                                    name="first_name" id="first_name" placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control formField reservation_formField" name="last_name"
                                    id="last_name" placeholder="Enter your last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control formField reservation_formField" placeholder="Enter your email"
                                required>
                        </div>
                        <div class="col-md-6 mb3">
                            <label for="phone">Phone</label>
                            <input type="phone" name="phone" id="phone"
                                class="form-control formField reservation_formField" placeholder="Enter your phone"
                                required>
                        </div>
                    </div>
                    <!-- Full-Width Section -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="address">Address</label>
                                <textarea rows="5" class="form-control formField reservation_formField" name="address"
                                    id="address" placeholder="Enter your address" required> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Textarea -->
                            <div class="mb-3">
                                <label for="requirements">Special Requirements</label>
                                <textarea style="height: 45px; font-size: 15px;" class="form-control" id="requirements"
                                    name="requirements" rows="1" placeholder="Enter your comments"></textarea>
                            </div>
                        </div>
                    </div>
                    {!! NoCaptcha::display() !!}
                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" style="background-color: #232B37;"
                                class="btn btn-success float-end text-white" id="submitBtn" style="font-size:18px"> <i
                                    class="fa-solid fa-location-arrow"></i> Book Now</button>
                        </div>
                    </div>
                </form>
                {!! NoCaptcha::renderJs() !!}
            </div>
        </div>
    </div>
</section>
<section id="Speacitial-feature">
    <div class="container mt-5 p-3 text-center ">
        <div class="row ">
            <div class="col-md-4 text-center">
                <div class="contactIcon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="contactHeading">Address</div>
                <h3 class="pt-2 pb-0 contactDescription">House #1 & 3, Road #21, Nikunja 2,<br/> Dhaka-1229, Bangladesh
                </h3>
            </div>
            <div class="col-md-4 text-center">
                <div class="contactIcon"><i class="fa-solid fa-phone"></i></div>
                <div class="contactHeading">Phone Support <small>24 Hours a Day</small></div>
                <div class="contactDescription">01756424224</div>
                <div class="contactDescription">reservation@hotelgrace21.com</div>
            </div>
            <div class="col-md-4 text-center">
                <div class="contactIcon"><i class="fa-solid fa-phone"></i></div>
                <div class="contactHeading">Hotline</div>
                <div class="contactDescription">01756424224</div>
                <div class="contactDescription">reservation@hotelgrace21.com</div>
            </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// =========== Multiple room types ==========
let roomIndex = 1;

function addRoomType() {
    const totalRoomTypes = document.querySelector('.roomtype-select').querySelectorAll('option:not([value=""])').length;
    if(roomIndex >= totalRoomTypes){
        return;
    }
    const container = document.getElementById("roomTypeContainer");
    const newGroup = document.createElement("div");
    newGroup.className = "row mt-2";

    newGroup.innerHTML = `
        <div class="col-md-6">
            <select name="roomtypes[${roomIndex}][type]" class="form-select formField" required>
                <option value="">-- Select --</option>
                <option value="Deluxe Single">Deluxe Single</option>
                <option value="Deluxe Double">Deluxe Double</option>
                <option value="Super Deluxe">Super Deluxe</option>
                <option value="Super Deluxe (Twin)">Super Deluxe (Twin)</option>
                <option value="Family Suit (Triple)">Family Suit (Triple)</option>
            </select>
        </div>
        <div class="col-md-5">
            <select name="roomtypes[${roomIndex}][count]" class="form-select roomtype-select formField" required>
                <option value="">-- Select --</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger w-100 mb-1" onclick="removeRoomType(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    `;

    container.appendChild(newGroup);
    roomIndex++;
}

function removeRoomType(button) {
    roomIndex--;
    button.closest(".row").remove();
}

//========= Reservation form submit =========
document.getElementById("reservationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = {};
    const formFields = document.querySelectorAll(".formField");    
    
    formFields.forEach(field => {
        // Check for roomtypes[0][type] or roomtypes[0][count]
        const match = field.name.match(/^roomtypes\[(\d+)]\[(type|count)]$/);

        if (match) {
            const index = parseInt(match[1]);
            const fieldType = match[2];

            // Initialize roomTypes array if it doesn't exist
            if (!formData.roomTypes) {
                formData.roomTypes = [];
            }

            // Initialize object at that index
            if (!formData.roomTypes[index]) {
                formData.roomTypes[index] = {};
            }

            // Assign the correct key
            if (fieldType === 'type') {
                formData.roomTypes[index].roomType = field.value;
            } else if (fieldType === 'count') {
                formData.roomTypes[index].noOfRoom = field.value;
            }
        } else {
            formData[field.name] = field.value;
        }
    });

    if (!formData.checkin || !formData.checkout) {
        Swal.fire({
            icon: 'error',
            title: 'Missing Dates',
            text: 'Please select both check in and check out dates!',
        });
        return; 
    }

    // const recaptchaResponse = grecaptcha.getResponse();
    // if (recaptchaResponse.length === 0) {
    //     // If CAPTCHA is not verified
    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Captcha Required',
    //         text: 'Please complete the CAPTCHA to proceed.',
    //     });
    //     return;
    // }

    console.log(formData,"xxxxx");

    const btn = document.getElementById("submitBtn");
    btn.disabled = true;
    btn.innerText = "Submitting...";

    fetch('/reservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data, "fff")
            btn.disabled = false;
            btn.innerText = "Book Now";
            Swal.fire({
                icon: 'success',
                title: 'Reservation Successful',
                text: 'Your reservation has been submitted successfully!',
            });
        })
        .catch(error => {
            console.log('Error:', error);

            Swal.fire({
                icon: 'error',
                title: 'Submission Failed',
                text: error.message,
            });
        });
   
    document.getElementById("reservationForm").reset();
    // grecaptcha.reset();
})

// document.addEventListener('DOMContentLoaded', function() {
//     const checkin = document.getElementById('checkin');
//     const checkout = document.getElementById('checkout');
//     const roomtype = document.getElementById('roomtype');

//     function availabilityCheck() {
//         const bodyData = {
//             checkin: checkin.value,
//             checkout: checkout.value,
//             roomtype: roomtype.value
//         };

//         // Make sure all values are filled before sending the request
//         if (bodyData.checkin && bodyData.checkout && bodyData.roomtype) {
//             // resultDiv.innerText = "Checking availability...";

//             fetch("{{ url('/reservation-check') }}", {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
//                     },
//                     body: JSON.stringify(bodyData)
//                 })
//                 .then(res => res.json())
//                 .then(data => {
//                     console.log(data, "xxxxxx");
//                     if (data.status == "success") {
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'Available!',
//                             text: data.message
//                         });
//                     } else {
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Not Available',
//                             text: data.message
//                         });
//                     }
//                 })
//                 .catch(err => {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Not Available',
//                         text: "Error checking availability"
//                     });
//                     console.log(err);
//                 });
//         }
//     }

//     // Attach onchange listeners
//     // [checkin, checkout, roomtype].forEach(input => {
//     //     input.addEventListener('change', availabilityCheck);
//     // });

// });
</script>
@endsection