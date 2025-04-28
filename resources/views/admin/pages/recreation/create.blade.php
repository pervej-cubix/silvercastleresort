@extends('admin.master')

@section('main')



<div class="row mt-10 mb-10">
    <div class="col-lg-10 offset-lg-1 col-md-12">
        <div class="card mt-4">
            <div class="card-header border-bottom">
                <h3 class="card-title">Add New Things to Do</h3>
            </div>
            <div class="card-body">
                @if( session('messages') )
                <p class="alert alert-success">{{ session('messages') }}</p>
                @endif
                <form class="form-horizontal" action="{{ route('recreation-store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">
                        <label for="name" class="col-md-3 form-label">Things to Do Name</label>
                        <div class="col-md-9">
                            <input class="form-control" name="name" id="name" placeholder="Enter your Things to Do Name" type="text" required="required">
                            @if($errors->has('name'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="icon" class="col-md-3 form-label">Icon</label>
                        <div class="col-md-9">
                            <input class="form-control" name="icon" id="icon" placeholder="Enter your icon" type="text" required="required">
                            @if($errors->has('icon'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('icon') }}</div>
                            @endif
                        </div>
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
                        <label for="accommodation_gallaries" class="col-md-3 form-label">Things to Do Galleries</label>
                        <div class="col-md-9">
                            <input type="file" name="recreation_galleries[]" id="recreation_galleries" accept="image/*" multiple />
                            @if($errors->has('recreation_gallaries'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('recreation_gallaries') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <label for="email" class="col-md-3 form-label">Publication Status</label>
                        <div class="col-md-9 mt-2 p">
                            <label><input type="radio" value="1" checked name="status"><span>Published</span></label>
                            <label><input type="radio" value="0" name="status"><span>UnPublished</span></label>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection