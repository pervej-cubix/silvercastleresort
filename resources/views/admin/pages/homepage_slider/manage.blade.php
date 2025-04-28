@extends('admin.master')

@section('main')

<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Add New Slide</h3>
                </div>
                <div class="card-body">
                    @if( session('saveMessage') )
                        <p class="alert alert-success">{{ session('saveMessage') }}</p>
                    @endif
                    <form class="form-horizontal" action="{{ route('homepage-slider-store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4 mt-4">
                        <label for="productImage" class="col-md-3 form-label">Image/Video</label>
                        <div class="col-md-9">
                            <div class="form-control">
                                <input type="file" name="file" class="dropify" data-height="200" accept="image/*,video/*" required>
                                @if($errors->has('file'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('file') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="fileType" class="col-md-3 form-label">Media Type</label>
                        <div class="col-md-9">
                            <select name="fileType" id="fileType" class="form-control">
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
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

    <div class="row mt-5">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title"> Homepage Slide Manage</h3>
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
                        <table id="example3" class="table table-bordered text-nowrap border-bottom">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">File</th>
                                <th class="border-bottom-0">File Type</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($homepageSliders as $slider) 
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{$slider->file}}
                                    </td>
                                    <td>
                                        @if($slider->fileType == 'video')
                                            <!-- For video, show a video thumbnail (or a placeholder image) -->
                                            <span><i class="fa-solid fa-video"></i></span>
                                        @else
                                            <!-- For image, show the image itself -->
                                            <img src="{{ asset('/assets/web/homepageSlider/' . $slider->file) }}" alt="Image" width="40" height="60">
                                        @endif                                   
                                    </td>
                                    <td>{{$slider->fileType}}</td> 
                                    <td>{{ $slider->status == 1 ? 'Published' : 'UnPublished' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('homepage-slider-edit', $slider->id) }}" class="btn btn-success btn-sm me-1">
                                            <i class=" fa fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{ route('homepage-slider.destroy', $slider->id) }}">
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