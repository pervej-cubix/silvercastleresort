@extends('admin.master')

@section('main')

<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4"> 
                <div class="card-header border-bottom">
                    <h3 class="card-title">Update Homepage slide</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('homepage-slider-update', $homepageSlider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mt-4">
                            <label for="productImage" class="col-md-3 form-label">Slide Image</label>
                            <div class="col-md-9">
                                <div class="form-control mt-5 mb-5">
                                    <input type="file" name="image" class="dropify" data-height="200" accept="image*/">
                                    @if($errors->has('image'))
                                        <div class="alert alert-danger mt-1">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="email" class="col-md-3 form-label">Publication Status</label>
                            <div class="col-md-9 mt-2 p"> 
                                <label ><input type="radio" value="1" {{ $homepageSlider->status == 1 ? 'checked' : '' }} name="status"><span>Published</span></label>
                                <label><input type="radio" value="0" {{ $homepageSlider->status == 0 ? 'checked' : '' }} name="status"><span>UnPublished</span></label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection