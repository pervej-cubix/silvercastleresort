@extends('admin.master')

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
                            <table id="reservation_manage" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl No.</th>
                                        <th class="border-bottom-0">Guest Name</th>
                                        <th class="border-bottom-0">Room Types</th>
                                        <th class="border-bottom-0">Quantity</th>
                                        <th class="border-bottom-0">Check In</th>
                                        <th class="border-bottom-0">Check Out</th>
                                        <th class="border-bottom-0">Contact</th>
                                        <th class="border-bottom-0">Stay <sub>(day)</sub></th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$item->title}} {{$item->first_name}} {{$item->last_name}}</td>
                                            <td>
                                                @foreach ($item->roomTypes as $room)
                                                    <div>{{ $room->room_type }} - {{ $room->no_of_room }}</div>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($item->roomTypes as $room)
                                                    <div>{{ $room->no_of_room }} room(s)</div>
                                                @endforeach
                                            </td>
                                            <td>{{$item->checkin_date}}</td>
                                            <td>{{$item->checkout_date}}</td>
                                            <td>
                                                <p class="mb-0">{{$item->phone}}</p>
                                                <p class="mb-0">{{$item->email}}</p>
                                            </td>
                                            <td>{{$item->day_count}}</td>
                                            <td>
                                                <form action="{{ route('reservation.status', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="reservation_status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                        <option value="-1" {{ old('reservation_status', $item->reservation_status) == -1 ? 'selected' : '' }}>Pending</option>
                                                        <option value="1" {{ old('reservation_status', $item->reservation_status) == 1 ? 'selected' : '' }}>Approved</option>
                                                        <option value="0" {{ old('reservation_status', $item->reservation_status) == 0 ? 'selected' : '' }}>Cancel</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="d-flex gap-2 align-items-center">
                                                <form method="post" action="{{ route('reservation.destroy', $item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </form>
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
    let checkoutPicker = flatpickr("#checkout", {
    dateFormat: "Y-m-d",
    minDate: "today",
    });

    flatpickr("#checkin", {
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                const minCheckout = new Date(selectedDates[0]);
                minCheckout.setDate(minCheckout.getDate() + 1); // Minimum checkout = checkin + 1
                checkoutPicker.set("minDate", minCheckout);
            }
        },
    });
</script>
