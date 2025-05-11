@extends('admin.master')
<style>
.modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
        padding-top: 60px;
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
        text-align: center;
    }

    /* Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Style the buttons */
    button {
        margin: 10px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #ddd;
    }

</style>
@section('main')
    <div class="row mt-5">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="border p-2 mb-2">
                <h4 class="card-title pb-2">Check Room Status</h4>
                <form method="GET" action="{{ route('reservation.index') }}" class="mb-4 row g-3">
                    <div class="col-md-6">
                        <label for="datepicker">Check in</label>
                        <input type="date" class="form-control formField reservation_formField" id="checkin"
                            name="checkin" placeholder="Select Date" required>
                    </div>
                    <div class="col-md-6">
                        <label for="checkout">Check out</label>
                        <input type="date" class="form-control formField reservation_formField" name="checkout"
                        id="checkout" placeholder="Select Date" required>
                    </div>
                      
                    <div class="col-md-6">
                        <label>Room Type</label>
                        <select name="room_type" class="form-select pt-1">
                            <option value="">All Room Types</option>
                            <option value="Deluxe Single" {{ request('room_type') === 'Deluxe Single' ? 'selected' : '' }}>
                                Deluxe Single
                            </option>
                            <option value="Deluxe Double" {{ request('room_type') === 'Deluxe Double' ? 'selected' : '' }}>
                                Deluxe Double
                            </option>
                            <option value="Super Deluxe" {{ request('room_type') === 'Super Deluxe' ? 'selected' : '' }}>
                                Super Deluxe
                            </option>
                            <option value="Super Deluxe (Twin)" {{ request('room_type') === 'Super Deluxe (Twin)' ? 'selected' : '' }}>
                                Super Deluxe (Twin)
                            </option>
                            <option value="Family Suit (Triple)" {{ request('room_type') === 'Family Suit(Triple)' ? 'selected' : '' }}>
                                Family Suit (Triple)
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Room Status</label>
                        <select name="reservation_status" class="form-select">
                            <option value="">All Status</option>
                            <option value="-1" {{ request('reservation_status') === '-1' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ request('reservation_status') === '1' ? 'selected' : '' }}>Approved</option>
                            <option value="0" {{ request('reservation_status') === '0' ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('reservation.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Manage Reservation</h3>
                </div>
                <div class="card-body">
                    @if( session('success') )
                        <p class="alert alert-success">{{ session('success') }}</p>
                    @endif
                    @if( session('message') )
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif
                    @if( session('errorr') )
                        <p class="alert alert-success">{{ session('error') }}</p>
                    @endif
                    <div class="table-responsive">                          
                        <div class="container">                                           
                            <!-- Reservation Table -->
                         <!-- Reservation Table -->
                        <table id="reservation_manage" class="table table-bordered text-nowrap border-bottom">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sl No.</th>
                                    <th class="border-bottom-0">Guest Name</th>
                                    <th class="border-bottom-0">Guest Type</th>
                                    <th class="border-bottom-0">Room Types</th>
                                    <th class="border-bottom-0">Quantity</th>
                                    <th class="border-bottom-0">Check In</th>
                                    <th class="border-bottom-0">Check Out</th>
                                    <th class="border-bottom-0">Contact</th>
                                    <th class="border-bottom-0">Stay <sub>(days)</sub></th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->guest_type }}</td> <!-- Added guest_type -->
                                        <td>
                                            @foreach ($item->roomTypes as $room)
                                                <div>{{ $room->room_type }} - {{ $room->no_of_room }} room(s)</div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->roomTypes as $room)
                                                <div>{{ $room->no_of_room }} room(s)</div>
                                            @endforeach
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->checkin)->format('F j, Y') }}</td> <!-- Formatted checkin date -->
                                        <td>{{ \Carbon\Carbon::parse($item->checkout)->format('F j, Y') }}</td> <!-- Formatted checkout date -->
                                        <td>
                                            <p class="mb-0">{{ $item->phone }}</p>
                                            <p class="mb-0">{{ $item->email }}</p>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->checkin)->diffInDays($item->checkout) }} days</td> <!-- Calculating the stay duration -->
                                        <td>
                                            @if($item->reservation_status == -1)
                                                <span class="badge bg-warning text-black">Pending</span>
                                            @elseif($item->reservation_status == 1)
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($item->reservation_status == 0)
                                                <span class="badge bg-danger">Cancel</span>
                                            @endif
                                        </td>

                                       <td class="d-flex gap-2 align-items-center justify-content-center" id="reservation-actions-{{ $item->id }}">
                                           @if($item->reservation_status != 0)
                                            <form class="w-75" method="POST" action="{{ route('reservation.status', $item->id) }}"
                                                id="statusToggleForm-{{ $item->id }}-toggle">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="reservation_status" value="{{ $item->reservation_status == -1 ? 1 : -1 }}">

                                                <button type="submit"
                                                    class="btn {{ $item->reservation_status == -1 ? 'btn-warning' : 'btn-secondary' }} btn-sm"
                                                    style="height: 30px; width: auto;"
                                                    title="{{ $item->reservation_status == -1 ? 'Approve Reservation' : 'Mark as Pending' }}">
                                                    {{ $item->reservation_status == -1 ? 'Approve' : 'Pending' }}
                                                </button>
                                            </form>
                                        @endif
                                        {{-- Send Mail --}}
                                        <form method="POST" action="{{ route('reservation.sendGuestMail', $item->id) }}" id="sendMailForm">
                                            @csrf
                                            <!-- Hidden input to hold the prompt value -->
                                            <input type="hidden" name="confirmation_status" id="confirmation_status" value="">
                                            <button type="button" class="btn btn-success btn-sm" style="height: 30px; width: 35px;" onclick="showModal()" title="Send Mail">
                                                <i class="fa-solid fa-paper-plane"></i>&nbsp
                                            </button>
                                        </form>

                                        <!-- Modal Popup -->
                                        <div id="sendMailModal" class="modal" style="display:none;">
                                            <div class="modal-content pb-4">
                                                <span class="close" onclick="closeModal()">&times;</span>
                                                <h2 class="py-3">Send mail To the guest</h2>
                                               <button class="mb-2 btn btn-success" onclick="setConfirmationStatus(1)">Send Approval Email</button>
                                                <button class="btn btn-danger" onclick="setConfirmationStatus(0)">Send Cancellation Email</button>
                                            </div>
                                        </div>
                                        {{-- Cancel --}}
                                         @if($item->reservation_status != 0)
                                        <form class="w-25" method="POST" action="{{ route('reservation.status', $item->id) }}"
                                            onsubmit="removeToggleForm({{ $item->id }})">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="reservation_status" value="0">
                                            <button 
                                                type="submit" 
                                                class="btn btn-danger btn-sm" 
                                                style="height: 30px; width: 35px;"
                                                onclick="return confirm('Are you sure?')" 
                                                title="Cancel Reservation"
                                                {{ $item->reservation_status == 0 ? 'disabled' : '' }}>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>                                                                                                                         
                                        </form>
                                         @endif 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center">
                                {{ $reservations->links() }}
                            </div>
                        </div>                                          
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>

    function removeToggleForm(id) {
        const toggleForm = document.getElementById(`statusToggleForm-${id}-toggle`);
        if (toggleForm) {
            toggleForm.remove();
        }
    }

    // ===== Send mail popup =====

     function showModal() {
        document.getElementById('sendMailModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('sendMailModal').style.display = 'none';
    }

    function submitForm() {
        // Submit the form when 'Yes, Send' is clicked
        document.getElementById('sendMailForm').submit();
    }
</script>
