@extends('admin.master')

@section('main')



<div class="row mt-10 mb-10">
    <div class="col-lg-10 offset-lg-1 col-md-12">
        <div class="card mt-4">
            <div class="card-header border-bottom">
                <h3 class="card-title">Add New Virtual Tour</h3>
            </div>
            <div class="card-body">
                @if( session('messages') )
                <p class="alert alert-success">{{ session('messages') }}</p>
                @endif
                <form class="form-horizontal" action="{{ route('tour-store') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        <label for="link" class="col-md-3 form-label">Link</label>
                        <div class="col-md-9">
                            <input class="form-control" name="link" id="link" placeholder="Enter your link" type="text" required="required">
                            @if($errors->has('link'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('link') }}</div>
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