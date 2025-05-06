@extends('web.main')
@section('content')
@include('sweetalert::alert')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    .card-title {
    font-size: 1.25rem;
    font-weight: 600;
    }

    .card-text {
        font-size: 0.95rem;
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

   /* Sliding panel that appears from the right */
    .personal-details-panel {
        position: fixed;
        top: 0;
        right: -100%;
        width: 400px;
        height: 100%;
        background-color: #f8f9fa;
        box-shadow: -2px 0px 5px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
        padding: 20px;
        z-index: 1000;
    }

    /* Close button for the panel */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 18px;
        background: none;
        border: none;
        cursor: pointer;
    }

    /* When panel is visible */
    .personal-details-panel.show {
        right: 0;
    }

    /* Styling for inputs and buttons in the panel */
    .personal-details-panel input, .personal-details-panel textarea {
        margin-bottom: 15px;
        width: 100%;
    }

    .personal-details-panel button {
        width: 100%;
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
                    <div class="card-body p-4 bg-light">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            {{ $accomodation->roomType }}
                            <a href="{{ route('roomDetails', $accomodation->slug) }}" class="text-decoration-none">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="card-text mb-1"><strong>Room Type:</strong> Grand King</p>
                                <p class="card-text mb-2">
                                    <strong>Size:</strong> {{ $accomodation->roomSize }} |
                                    <strong>Rooms:</strong> {{ $accomodation->noRoom }}
                                </p>
                            </div>
                            <div>
                                <p class="card-text mb-1"><strong>Rake Rate:</strong> <span class="text-decoration-line-through">{{$accomodation->rakeRate}}</span></p>
                                <p class="card-text mb-1"><strong>Discount:</strong> 00</p>
                            </div>
                        </div>
        
                        <!-- Add Room Button -->
                        <button class="btn btn-primary btn-sm add-room-btn mt-2" type="button" data-target="#roomForm-{{ $loop->index }}" data-roomtype="{{ $accomodation->roomType }}">
                            Add Room
                        </button>
        
                        <!-- Expandable Form Section -->
                        <div id="roomForm-{{ $loop->index }}" class="mt-3 d-none room-form">
                            <div class="mb-2">
                                <label for="rooms-{{ $loop->index }}" class="form-label">No. of Rooms</label>
                                <select class="form-select room-count-select" name="roomtypes[{{ $loop->index }}][count]" id="rooms-{{ $loop->index }}">
                                  <!-- Dynamically populated -->
                                </select>
                              </div>
                              
                              <!-- Dynamic Guest Input Fields -->
                              <div class="dynamic-guests mb-2"></div>
                            
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
        <div id="personal-details-panel" class="personal-details-panel">
            <button id="close-panel" class="close-btn">X</button>
            <div class="show_added_room">

            </div>
            <h3>Personal Details</h3>
            <form id="personal-details-form">
                <div class="mb-2">
                    <label for="full-name">Full Name</label>
                    <input type="text" class="form-control" id="full-name" placeholder="Enter Full Name" required>
                </div>
                <div class="mb-2">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
                </div>
                <div class="mb-2">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" required>
                </div>
                <div class="mb-2">
                    <label for="special-requests">Special Requests</label>
                    <textarea class="form-control" id="special-requests" placeholder="Enter Special Requests" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Proceed to Book</button>
            </form>
        </div>        
    </div>
</section>

@endsection

<script>
    // ==== Search Reservation ======  
    document.addEventListener("DOMContentLoaded", function () {
    const addRoomButtons = document.querySelectorAll('.add-room-btn');
    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');

    // Reusable function to fetch and populate availability
    async function fetchAndPopulateAvailability(button) {
    const card = button.closest('.itemAccummo');

    if (!checkin.value || !checkout.value) return;

    const roomType = button.getAttribute('data-roomtype')?.trim();
    if (!roomType) return;

    const roomCountInput = card.querySelector('select[name*="count"]');
    const guestFieldsContainer = card.querySelector('.dynamic-guests');

    // Clear any previously rendered fields
    guestFieldsContainer.innerHTML = "";

    const requestData = {
        checkin: checkin.value,
        checkout: checkout.value,
        roomTypes: [{ roomType }]
    };

    try {
        const response = await fetch('/reservation-check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(requestData)
        });

        const { data } = await response.json();
        const available = data.hasOwnProperty(roomType) ? data[roomType] : 0;

        roomCountInput.innerHTML = "";

        if (available > 0) {
            const defaultOpt = document.createElement("option");
            defaultOpt.value = "";
            defaultOpt.textContent = "Select number of rooms";
            roomCountInput.appendChild(defaultOpt);

            for (let i = 1; i <= available; i++) {
                const opt = document.createElement("option");
                opt.value = i;
                opt.textContent = i;
                roomCountInput.appendChild(opt);
            }
        } else {
            const opt = document.createElement("option");
            opt.value = 0;
            opt.textContent = "No rooms available";
            roomCountInput.appendChild(opt);
        }

        // Attach change listener for dynamic fields
        roomCountInput.addEventListener('change', function () {
            const roomCount = parseInt(this.value);
            guestFieldsContainer.innerHTML = ""; // clear existing fields

            if (roomCount > 0) {
                for (let i = 1; i <= roomCount; i++) {
                    const roomGroup = document.createElement("div");
                    roomGroup.classList.add("mb-1", "border", "p-2", "rounded");

                    roomGroup.innerHTML = `
                        <div class="row g-1 align-items-center mb-1">
                            <div class="col-12 col-sm-2">
                                <h6 class="mb-0">R${i}</h6>
                            </div>
                            <div class="col-12 col-sm-5">
                                <input type="number" class="form-control form-control-sm" placeholder="Adults" 
                                    name="roomtypes[${roomType}][room${i}][adults]" 
                                    min="1" max="3" required>
                            </div>
                            <div class="col-12 col-sm-5">
                                <input type="number" class="form-control form-control-sm" placeholder="Children"
                                    name="roomtypes[${roomType}][room${i}][children]" 
                                    min="0" max="2">
                            </div>
                        </div>
                    `;

                    guestFieldsContainer.appendChild(roomGroup);
                }
            }
        });

    } catch (err) {
        console.error("API Error:", err);
    }
}

    // Event listener for Add Room button
    addRoomButtons.forEach(button => {
        button.addEventListener('click', async () => {
            if (!checkin.value || !checkout.value) {
                alert("Please select both Check-in and Check-out dates first.");
                return;
            }

            await fetchAndPopulateAvailability(button);

            // Toggle form visibility
            const targetId = button.getAttribute('data-target');
            const form = document.querySelector(targetId);
            if (form.classList.contains('d-none')) {
                form.classList.remove('d-none');
                button.textContent = "Cancel";
            } else {
                form.classList.add('d-none');
                button.textContent = "Add Room";
            }
        });
    });

    // Update availability on checkin/checkout change
    [checkin, checkout].forEach(input => {
        input.addEventListener('change', () => {
            addRoomButtons.forEach(button => {
                const form = document.querySelector(button.getAttribute('data-target'));
                if (!form.classList.contains('d-none')) {
                    fetchAndPopulateAvailability(button);
                }
            });
        });
    });
});

// Wait until the DOM is fully loaded before adding event listeners
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.confirm-room-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Show the personal details panel
            document.getElementById('personal-details-panel').classList.add('show');
        });
    });

    document.getElementById('close-panel').addEventListener('click', function() {
        // Close the personal details panel
        document.getElementById('personal-details-panel').classList.remove('show');
    });
})

// === After confirm or Add Room ====
document.addEventListener("DOMContentLoaded", function () {
  const confirmButtons = document.querySelectorAll('.confirm-room-btn');
  const checkin = document.getElementById('checkin');
  const checkout = document.getElementById('checkout');
  const showAddedRoom = document.querySelector('.show_added_room');

  let confirmedRooms = [];

  confirmButtons.forEach(button => {
    button.addEventListener('click', () => {
      const formId = button.getAttribute('data-form-id');
      const form = document.getElementById(formId);
      if (!form) return;

      const roomType = form.querySelector('input[name*="[type]"]').value;
      const roomCount = parseInt(form.querySelector('select[name*="[count]"]').value || 0);
      const checkinDate = checkin.value;
      const checkoutDate = checkout.value;

      const roomDetails = [];

      for (let i = 1; i <= roomCount; i++) {
        const adultInput = form.querySelector(`input[name="roomtypes[${roomType}][room${i}][adults]"]`);
        const childInput = form.querySelector(`input[name="roomtypes[${roomType}][room${i}][children]"]`);
        if (adultInput && childInput) {
          roomDetails.push({
            roomType,
            room: i,
            adults: parseInt(adultInput.value || 0),
            children: parseInt(childInput.value || 0)
          });
        }
      }

      let group = confirmedRooms.find(
        r => r.checkin === checkinDate && r.checkout === checkoutDate
      );

      if (!group) {
        group = {
          id: Date.now(),
          checkin: checkinDate,
          checkout: checkoutDate,
          roomTypes: [],
          rooms: []
        };
        confirmedRooms.push(group);
      }

      // Replace any previous data of the same room type
      group.roomTypes = group.roomTypes.filter(rt => rt.roomType !== roomType);
      group.rooms = group.rooms.filter(r => r.roomType !== roomType);

      group.roomTypes.push({
        roomType,
        no_of_room: roomCount
      });

      group.rooms.push(...roomDetails);

      // Disable confirm button after confirmation
      button.disabled = true;

      renderConfirmedRooms();
      console.log(confirmedRooms,"pxpxpx");
    });
  });

  function renderConfirmedRooms() {
    showAddedRoom.innerHTML = '';

    confirmedRooms.forEach(roomGroup => {
      const div = document.createElement('div');
      div.className = 'border p-2 mb-2 rounded bg-light';

      const nights = calculateNights(roomGroup.checkin, roomGroup.checkout);

      let roomHTML = `
        <div class="row align-items-center g-2 flex-wrap mb-2 mt-2">
          <div class="col-auto">
            <span class="badge rounded-pill bg-primary px-3 py-2" style="font-size: 16px;">
              ${formatDate(roomGroup.checkin)}
            </span>
          </div>
          <div class="col-auto">
            <span class="badge rounded-pill bg-warning text-dark px-3 py-2" style="font-size: 16px;">
              <strong>${nights}</strong> Night${nights > 1 ? 's' : ''}
            </span>
          </div>
          <div class="col-auto">
            <span class="badge rounded-pill bg-success px-3 py-2" style="font-size: 16px;">
              ${formatDate(roomGroup.checkout)}
            </span>
          </div>
        </div>
      `;

      roomGroup.roomTypes.forEach(rt => {
        const matchingRooms = roomGroup.rooms.filter(r => r.roomType === rt.roomType);
        const totalAdults = matchingRooms.reduce((sum, r) => sum + r.adults, 0);
        const totalChildren = matchingRooms.reduce((sum, r) => sum + r.children, 0);

        roomHTML += `
          <div class="card mb-3 shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0" style="font-size: 17px;"><strong>Room Type:</strong> ${rt.roomType}</h5>
                <span class="badge bg-secondary">Rooms: ${rt.no_of_room}</span>
              </div>

              <table class="table table-sm table-bordered mb-3">
                <thead class="table-light">
                  <tr>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>${totalAdults}</td>
                    <td>${totalChildren}</td>
                    <td>
                      <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-danger" onclick="removeRoom(${roomGroup.id}, '${rt.roomType}')">
                          <i class="fa-solid fa-xmark"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="editRoom(${roomGroup.id}, '${rt.roomType}')">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        `;
      });

      div.innerHTML = roomHTML;
      showAddedRoom.appendChild(div);
    });
  }

  window.removeRoom = function (groupId, roomType) {
    const group = confirmedRooms.find(g => g.id === groupId);
    if (!group) return;

    group.roomTypes = group.roomTypes.filter(rt => rt.roomType !== roomType);
    group.rooms = group.rooms.filter(r => r.roomType !== roomType);

    if (group.roomTypes.length === 0) {
      confirmedRooms = confirmedRooms.filter(g => g.id !== groupId);
    }

    renderConfirmedRooms();
  };

  window.editRoom = function (groupId, roomType) {
    const group = confirmedRooms.find(g => g.id === groupId);
    if (!group) return;

    const form = document.querySelector(`input[value="${roomType}"]`)?.closest('.room-form');
    if (!form) return;

    form.classList.remove('d-none');
    form.scrollIntoView({ behavior: 'smooth' });

    const roomCount = group.roomTypes.find(rt => rt.roomType === roomType)?.no_of_room || 0;
    const countSelect = form.querySelector(`select[name*="[count]"]`);
    countSelect.value = roomCount;

    const matchingRooms = group.rooms.filter(r => r.roomType === roomType);
    for (let i = 1; i <= roomCount; i++) {
      const adult = form.querySelector(`input[name="roomtypes[${roomType}][room${i}][adults]"]`);
      const child = form.querySelector(`input[name="roomtypes[${roomType}][room${i}][children]"]`);
      if (adult) adult.value = matchingRooms[i - 1]?.adults ?? '';
      if (child) child.value = matchingRooms[i - 1]?.children ?? '';
    }

    // Enable the corresponding confirm button again
    const confirmBtn = document.querySelector(`.confirm-room-btn[data-form-id="${form.id}"]`);
    if (confirmBtn) confirmBtn.disabled = false;

    group.roomTypes = group.roomTypes.filter(rt => rt.roomType !== roomType);
    group.rooms = group.rooms.filter(r => r.roomType !== roomType);

    if (group.roomTypes.length === 0) {
      confirmedRooms = confirmedRooms.filter(g => g.id !== groupId);
    }

    renderConfirmedRooms();
  };

  function formatDate(dateStr) {
    const date = parseDateFromDDMMYYYY(dateStr);
    const options = { weekday: 'short', month: 'short', day: 'numeric' };
    return date.toLocaleDateString(undefined, options);
    }

    function parseDateFromDDMMYYYY(dateStr) {
        const [day, month, year] = dateStr.split('-').map(Number);
        return new Date(year, month - 1, day); // Month is 0-indexed in JS
    }

    function calculateNights(checkin, checkout) {
        const checkinDate = parseDateFromDDMMYYYY(checkin);
        const checkoutDate = parseDateFromDDMMYYYY(checkout);
        const timeDiff = checkoutDate - checkinDate;
        return Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    }
});

</script>