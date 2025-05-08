@extends('admin.master')

@section('main')



<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Accomodation</h3>
                </div>
                <div class="card-body">
                    @if( session('messages') )
                    <p class="alert alert-success">{{ session('messages') }}</p>
                    @endif
                    <form class="form-horizontal" action="{{ route('accommodation-update',$accomodation->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label for="roomType" class="col-md-3 form-label">Room Type</label>
                            <div class="col-md-9">
                                <input class="form-control" name="roomType" value="{{ $accomodation->roomType }}" id="roomType" placeholder="Enter your Room Type" type="text" required="required">
                                @if($errors->has('roomType'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('roomType') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="roomSize" class="col-md-3 form-label">Room Size</label>
                            <div class="col-md-9">
                                <input class="form-control" name="roomSize" value="{{ $accomodation->roomSize }}" id="roomSize" placeholder="Enter your Room Size" type="text" required="required">
                                @if($errors->has('roomSize'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('roomSize') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="noRoom" class="col-md-3 form-label">No of Room</label>
                            <div class="col-md-9">
                                <input class="form-control" name="noRoom" value="{{ $accomodation->noRoom }}" id="noRoom" placeholder="Enter your No of Room" type="number" required="required">
                                @if($errors->has('noRoom'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('noRoom') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="occupancy" class="col-md-3 form-label">Occupancy</label>
                            <div class="col-md-9">
                                <input class="form-control" name="occupancy" value="{{ $accomodation->occupancy }}" id="occupancy" placeholder="Enter your Occupancy" type="number" required="required">
                                @if($errors->has('occupancy'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('occupancy') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="rackRate" class="col-md-3 form-label">Room Rack Rate</label>
                            <div class="col-md-9">
                                <input class="form-control" name="rackRate" value={{ $accomodation->rackRate }} id="rackRate" placeholder="Enter your room rack rate" type="number">
                               
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="discountedRate" class="col-md-3 form-label">Discounted Rate</label>
                            <div class="col-md-9">
                                <input class="form-control" name="discountedRate" value={{ $accomodation->discountedRate }} id="discountedRate" placeholder="Enter your discounted rate" type="number">
                                
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="description" class="col-md-3 form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="4" placeholder="Enter your Description">{{ $accomodation->description }}</textarea>
                                @if($errors->has('description'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4 mt-4">
                            <label for="image" class="col-md-3 form-label">Display Image</label>
                            <div class="col-md-9">
                                <div class="form-control">
                                    <input type="file" name="image" class="dropify" id="image" data-height="200" accept="image/*">
                                    {{-- @if($errors->has('image'))
                                        <div class="alert alert-danger mt-1">{{ $errors->first('image') }}</div>
                                    @endif --}}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="accommodation_gallaries" class="col-md-3 form-label">Accommodation Gallaries</label>
                            <div class="col-md-9">
                                <input type="file" name="accommodation_gallaries[]" id="accommodation_gallaries" accept="image/*" multiple />
                                @if($errors->has('accommodation_gallaries'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('accommodation_gallaries') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row">
                            <label for="email" class="col-md-3 form-label">Publication Status</label>
                            <div class="col-md-9 mt-2 p">
                                <label ><input type="radio" value="1" {{ $accomodation->status ==1 ? 'checked' : '' }} name="status"><span>Published</span></label>
                                <label><input type="radio" value="0" {{ $accomodation->status ==0 ? 'checked' : '' }} name="status"><span>UnPublished</span></label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection