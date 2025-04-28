@extends('admin.master')

@section('main')



<div class="row mt-10 mb-10">
    <div class="col-lg-10 offset-lg-1 col-md-12">
        <div class="card mt-4">
            <div class="card-header border-bottom">
                <h3 class="card-title">Edit Stars</h3>
            </div>
            <div class="card-body">
                @if( session('messages') )
                <p class="alert alert-success">{{ session('messages') }}</p>
                @endif
                <form class="form-horizontal" action="{{ route('star-update',$star->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <?php if (!empty($star->title) && $star->status == 1) {
                    ?>
                        <div class="row mb-4">
                            <label for="title" class="col-md-3 form-label">Title</label>
                            <div class="col-md-9">
                                <input class="form-control" name="title" value="{{ $star->title }}" id="title" placeholder="Enter your title" type="text" required="required">
                                @if($errors->has('title'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>

                    <?php } ?>
                    <div class="row mb-4">
                        <label for="second_title" class="col-md-3 form-label">Second Title</label>
                        <div class="col-md-9">
                            <input class="form-control" name="second_title" value="{{ $star->second_title }}" id="second_title" placeholder="Enter your second title" type="text" required="required">
                            @if($errors->has('second_title'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('second_title') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="icon" class="col-md-3 form-label">Icon</label>
                        <div class="col-md-9">
                            <input class="form-control" name="icon" value="{{ $star->icon }}" id="icon" placeholder="Enter your icon" type="text" required="required">
                            @if($errors->has('icon'))
                            <div class="alert alert-danger mt-1">{{ $errors->first('icon') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="description" class="col-md-3 form-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" cols="30" rows="4" placeholder="Enter your Description">{{ $star->description }}</textarea>
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
                                @if($errors->has('image'))
                                <div class="alert alert-danger mt-1">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="email" class="col-md-3 form-label">Publication Status</label>
                        <div class="col-md-9 mt-2 p">
                            <label><input type="radio" value="1" {{ $star->status ==1 ? 'checked' : '' }} name="status"><span>Published</span></label>
                            <label><input type="radio" value="0" {{ $star->status ==0 ? 'checked' : '' }} name="status"><span>UnPublished</span></label>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection