@extends('admin.master')

@section('main')


<div class="row mt-5">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Accommodation Manage</h3>
            </div>
            <div class="card-body">
                @if( session('success') )
                <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if( session('message') )
                <p class="alert alert-success">{{ session('message') }}</p>
                @endif
                @if( session('errorr') )
                <p class="alert alert-success">{{ session('errorr') }}</p>
                @endif
                <div class="table-responsive">
                    <table id="example3" class="table table-bordered text-nowrap border-bottom">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Room Type</th>
                                <th class="border-bottom-0">Room Size</th>
                                <th class="border-bottom-0">No of Room</th>
                                <th class="border-bottom-0">Occupancy</th>
                                <th class="border-bottom-0">Room Rake Rate</th>
                                <th class="border-bottom-0">Description</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Accommodation Gallaries</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accomodations as $accomodation)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $accomodation->roomType }}</td>
                                <td>{{ $accomodation->roomSize }}</td>
                                <td>{{ $accomodation->noRoom }}</td>
                                <td>{{ $accomodation->occupancy }}</td>
                                <td>{{ $accomodation->rakeRate }}</td>
                                <td>{{ $accomodation->description }}</td>
                                <td><img src="{{ asset($accomodation->image) }}" alt="" width="40" height="60"></td>
                                <td>
                                    @if($accomodation->accommodation_gallaries && count($accomodation->accommodation_gallaries) > 0)
                                    @foreach($accomodation->accommodation_gallaries as $accommodation_gallary)
                                    <img class="m-1" src="{{ asset($accommodation_gallary->accommodation_photo) }}" alt="" height="120">
                                    @endforeach
                                    @else
                                    <p>No Galleries Available</p>
                                    @endif
                                </td>
                                <td>{{ $accomodation->status == 1 ? 'Published' : 'UnPublished' }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('accommodation-edit',$accomodation->id) }}" class="btn btn-success btn-sm me-1">
                                        <i class=" fa fa-edit"></i>
                                    </a>
                                    <form method="post" action="{{ route('accommodation.destroy', $accomodation->id) }}">
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


@endsection