@extends('admin.master')

@section('main')



<div class="row mt-10 mb-10">
    <div class="col-lg-10 offset-lg-1 col-md-12">
        <div class="card mt-4">
            <div class="card-header border-bottom">
                <h3 class="card-title">Edit Address</h3>
            </div>
            <div class="card-body">
                @if( session('messages') )
                <p class="alert alert-success">{{ session('messages') }}</p>
                @endif
                <form class="form-horizontal" action="{{ route('address-update',$address->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <label for="title" class="col-md-3 form-label">Title</label>
                        <div class="col-md-9">
                            <input class="form-control" name="title" value="{{ $address->title }}" id="title" placeholder="Enter your title" type="text" required="required">
                            @if($errors->has('title'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="icon" class="col-md-3 form-label">Icon</label>
                        <div class="col-md-9">
                            <input class="form-control" name="icon" value="{{ $address->icon }}" id="icon" placeholder="Enter your icon" type="text" required="required">
                            @if($errors->has('icon'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('icon') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="address" class="col-md-3 form-label">address</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="address" id="address" cols="30" rows="4" placeholder="Enter your address">{{ $address->address }}</textarea>
                            @if($errors->has('address'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <label for="email" class="col-md-3 form-label">Publication Status</label>
                        <div class="col-md-9 mt-2 p">
                            <label><input type="radio" value="1" {{ $address->status ==1 ? 'checked' : '' }} name="status"><span>Published</span></label>
                            <label><input type="radio" value="0" {{ $address->status ==0 ? 'checked' : '' }} name="status"><span>UnPublished</span></label>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection