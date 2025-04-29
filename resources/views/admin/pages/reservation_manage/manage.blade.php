@extends('admin.master')

@section('main')
    <div class="row mt-5">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="border p-2 mb-2">
                <h4 class="card-title pb-2">Check Room Status</h4>
                <form method="GET" action="{{ route('reservation.index') }}" class="mb-4 row g-3">
                    <div class="col-md-6">
                        <label>Check In</label>
                        <input type="date" name="checkin_date" id="checkin" class="form-control pt-1" value="{{ request('checkin_date') }}" placeholder="Check-in Date">
                    </div>
                    <div class="col-md-6">
                        <label>Check Out</label>
                        <input type="date" name="checkout_date" id="checkout" class="form-control pt-1" value="{{ request('checkout_date') }}" placeholder="Check-out Date">
                    </div>
                    <div class="col-md-6">
                        <label>Room Type</label>
                        <select name="room_type" class="form-select pt-1">
                            <option value="">All Room Types</option>
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
                    </div>
                    <div class="col-md-6">
                        <label>Room Status</label>
                        <select name="reservation_status" class="form-select">
                            <option value="">All Status</option>
                            <option value="1" {{ request('reservation_status') === '1' ? 'selected' : '' }}>Assign</option>
                            <option value="0" {{ request('reservation_status') === '0' ? 'selected' : '' }}>UnAssign</option>
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
                    <!-- Button trigger modal -->
                    {{-- <div class="text-end w-100">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#room_status">
                            Room Status
                        </button>
                    </div>                    
                    <!-- Modal -->
                    <div class="modal fade" id="room_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <!-- Your content here -->
                            ...
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        
                        </div>
                    </div>
                    </div> --}}

                        <div>                        
                            <table id="reservation_manage" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    @php
                                    $totalAssigned = $reservations->where('reservation_status', 1)->count();
                                    $totalUnAssigned = $reservations->where('reservation_status', 0)->count();
                                @endphp

                                <tr>
                                    <td colspan="9" class="text-end fw-bold bg-light">
                                        Total Assigned Rooms: {{ $totalAssigned }} |
                                        Total Unassigned Rooms: {{ $totalUnAssigned }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border-bottom-0">Sl No.</th>
                                    <th class="border-bottom-0">Guest Name</th>
                                    <th class="border-bottom-0">Room Type</th>
                                    <th class="border-bottom-0">Check In</th>
                                    <th class="border-bottom-0">Check Out</th>
                                    <th class="border-bottom-0">Phone</th>
                                    <th class="border-bottom-0">Email</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                @foreach($reservations as $item) 
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>                   
                                        <td>{{$item->title}} {{$item->first_name}} {{$item->last_name}}</td> 
                                        <td>{{$item->room_type}}</td>                                     
                                        <td>{{$item->checkin_date}}</td> 
                                        <td>{{$item->checkout_date}}</td> 
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            <form action="{{ route('reservation.status', $item->id) }}" method="POST">
                                                @csrf 
                                                @method('PUT')
                                                <select name="reservation_status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                    <option value="1" {{ $item->reservation_status == 1 ? 'selected' : '' }}>Approved</option>
                                                    <option value="0" {{ $item->reservation_status == 0 ? 'selected' : '' }}>Pending</option>
                                                </select>
                                                
                                            </form>                                        
                                        </td> 
                                        <td class="d-flex gap-2">
                                            <form method="POST" action="{{ route('reservation.sendGuestMail', $item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Did you approve the reservation?')">
                                                    <i class="fa-solid fa-envelope"></i>&nbsp;Send Mail
                                                </button>
                                            </form>
                                            <form method="post" action="{{ route('reservation.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>                                                                         
                                    </tr>
                                @endforeach

                             
                                </tbody>
                            </table>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

