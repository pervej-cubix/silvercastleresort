@extends('admin.master')

@section('main')

<style>
    #calendar-grid, #calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }
    .calendar-cell:hover {
        background-color: #dbeafe;
    }

    .calendar-cell {
        cursor: pointer;
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
  }

  .active-date {
        background-color: #0d6efd !important;
        color: white;
        font-weight: bold;
  }
</style>

<div class="container">
       <div class="p-4">
            <h3>Enter Available Room</h3>                        
       </div>
       
        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 z-3" role="alert" style="min-width: 500px; z-index: 1055;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
    <div id="calendar-controls" class="d-flex justify-content-between align-items-center mb-3">
        <button id="prev-month" class="btn btn-outline-primary btn-sm">Previous</button>
            <h5 id="calendar-month-year" class="mb-0"></h5>
        <button id="next-month" class="btn btn-outline-primary btn-sm">Next</button>
    </div>
    
    <div id="calendar-days" class="row row-cols-7 text-center fw-bold mb-1">
        <div>Sun</div>
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
    </div>
    <div id="calendar-grid" class="row row-cols-7 g-1"></div>
    
    <form id="resetRoomsForm" class="text-end mt-5" action="{{ route('available-rooms.reset') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fa-solid fa-trash"></i> Reset Rooms
        </button>
    </form>
    
    <!-- Modal -->
    <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="dateModalLabel">Room Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('available_room-store') }}" method="POST">
                @csrf
                @php
                    $roomTypes = ['Deluxe Single', 'Super Double', 'Super Deluxe', 'Super Deluxe (Twin)', 'Family Suit (Triple)'];
                @endphp
                    <div class="text-center mb-4">
                        <input type="text" class="px-4 py-2 text-center" style="font-size: 18px; font-weight: 600;" readonly name="date" id="selected-date-text">
                    </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Room Type</th>
                            <th>Number of Rooms</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roomTypes as $type)
                            <tr>
                                <td>{{ $type }}</td>
                                <td>
                                    <input type="number"value="" name="room_types[{{ $type }}]" class="form-control" placeholder="Enter number of rooms" min="0">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            <!-- You can add a form or content here -->
          </div>
        </div>
      </div>
    </div>    
    
        {{-- <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Room Type</th>
                        <th>Date</th>
                        <th>No. of Rooms</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($availableRooms as $room)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $room->room_type }}</td>
                        <td>{{ $room->start_date }}</td>
                        <td>
                            <form action="{{ route('available_room-update', $room->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <input type="number" name="no_of_rooms" value="{{ $room->no_of_rooms }}" class="form-control" min="1" style="width:100px; margin-right:10px;">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('available_room.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div> --}}
</div>
@endsection