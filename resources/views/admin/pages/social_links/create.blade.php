@extends('admin.master')

@section('main')



<div class="row mt-10 mb-10">
    <div class="col-lg-10 offset-lg-1 col-md-12">
        <div class="card mt-4">
            <div class="card-header border-bottom">
                <h3 class="card-title">Add New Social Links</h3>
            </div>
            <div class="card-body">
                @if( session('messages') )
                <p class="alert alert-success">{{ session('messages') }}</p>
                @endif
                <form class="form-horizontal" action="{{ route('social-store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-4">
                        <label for="mobile" class="col-md-3 form-label">Mobile</label>
                        <div class="col-md-9">
                            <input class="form-control" name="mobile" id="mobile" placeholder="Enter your mobile number" type="number" required="required">
                            @if($errors->has('mobile'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('mobile') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="map_link" class="col-md-3 form-label">Map Link</label>
                        <div class="col-md-9">
                            <input class="form-control" name="map_link" id="map_link" placeholder="Enter your link" type="text" required="required">
                            @if($errors->has('map_link'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('map_link') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="fb_link" class="col-md-3 form-label">Facebook Link</label>
                        <div class="col-md-9">
                            <input class="form-control" name="fb_link" id="fb_link" placeholder="Enter facebook link" type="text" required="required">
                            @if($errors->has('fb_link'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('fb_link') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="instagram_link" class="col-md-3 form-label">Instagram Link</label>
                        <div class="col-md-9">
                            <input class="form-control" name="instagram_link" id="instagram_link" placeholder="Enter instagram link" type="text" required="required">
                            @if($errors->has('instagram_link'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('instagram_link') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="youtube_link" class="col-md-3 form-label">Youtube Link</label>
                        <div class="col-md-9">
                            <input class="form-control" name="youtube_link" id="youtube_link" placeholder="Enter facebook link" type="text" required="required">
                            @if($errors->has('youtube_link'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('youtube_link') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="whatsapp_link" class="col-md-3 form-label">Whatsapp Link</label>
                        <div class="col-md-9">
                            <input class="form-control" name="whatsapp_link" id="whatsapp_link" placeholder="Enter facebook link" type="text" required="required">
                            @if($errors->has('whatsapp_link'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('whatsapp_link') }}</div>
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