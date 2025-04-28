@extends('admin.master')

@section('main')



<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Accomodation</h3>
                </div>
                <div class="card-body">
                    
                    <form class="form-horizontal" action="{{ route('dining-update',$dining->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <label for="diningName" class="col-md-3 form-label">Dining Name</label>
                            <div class="col-md-9">
                                <input class="form-control" name="diningName" value="{{ $dining->diningName }}" id="diningName" placeholder="Enter your Room Type" type="text" required="required">
                                @if($errors->has('diningName'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('diningName') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="description" class="col-md-3 form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="4" placeholder="Enter your Description">{{ $dining->description }}</textarea>
                                @if($errors->has('description'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <input class="form-control col-md-6" name="Features1" value="{{ $dining->Features1 }}" placeholder="Enter your Features 1" type="text" required="required">
                            <input class="form-control col-md-6" name="Features2" value="{{ $dining->Features2 }}" placeholder="Enter your Features 2" type="text" required="required">
                            @if($errors->has('Features1'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('Features1') }}</div>
                            @endif
                            @if($errors->has('Features2'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('Features2') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <input class="form-control col-md-6" name="Features3" value="{{ $dining->Features3 }}" placeholder="Enter your Features 1" type="text">
                            <input class="form-control col-md-6" name="Features4" value="{{ $dining->Features4 }}" placeholder="Enter your Features 2" type="text">
                            @if($errors->has('Features3'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('Features3') }}</div>
                            @endif
                            @if($errors->has('Features4'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('Features4') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <input class="form-control col-md-6" name="Features5" value="{{ $dining->Features5 }}" placeholder="Enter your Features 1" type="text">
                            <input class="form-control col-md-6" name="Features6" value="{{ $dining->Features6 }}" placeholder="Enter your Features 2" type="text">
                            @if($errors->has('Features5'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('Features5') }}</div>
                            @endif
                            @if($errors->has('Features6'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('Features6') }}</div>
                            @endif
                        </div>




                        <div class="row mb-4 mt-4">
                            <label for="image" class="col-md-3 form-label">Display Image</label>
                            <div class="col-md-9">
                                <div class="form-control">
                                    <input type="file" name="image" class="dropify" id="image" data-height="200" accept="image/*">
                                    @if($errors->has('image'))
                                        <div class="alert alert-danger mt-1">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="dining_gallaries" class="col-md-3 form-label">Dining Gallaries</label>
                            <div class="col-md-9">
                                <input type="file" name="dining_gallaries[]" id="dining_gallaries" accept="image/*" multiple />
                                @if($errors->has('dining_gallaries'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('dining_gallaries') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row">
                            <label for="email" class="col-md-3 form-label">Publication Status</label>
                            <div class="col-md-9 mt-2 p">
                                <label ><input type="radio" value="1" {{ $dining->status ==1 ? 'checked' : '' }} name="status"><span>Published</span></label>
                                <label><input type="radio" value="0" {{ $dining->status ==0 ? 'checked' : '' }} name="status"><span>UnPublished</span></label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection