@extends('admin.master')

@section('main')

<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4"> 
                <div class="card-header border-bottom">
                    <h3 class="card-title">Update About us content</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('aboutUs-update', $aboutUs->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        <!-- Title -->
                        <div class="row mb-4 mt-4">
                            <label for="title" class="col-md-3 form-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" value="{{ old('title', $aboutUs->title) }}" placeholder="Enter title" required>
                                @if($errors->has('title'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>
                    
                        <!-- Description -->
                        <div class="row mb-4">
                            <label for="description" class="col-md-3 form-label">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" rows="5" placeholder="Enter description">{{ old('description', $aboutUs->description) }}</textarea>
                                @if($errors->has('description'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                    
                        <!-- Image -->
                        <div class="row mb-4">
                            <label for="image" class="col-md-3 form-label">Content Image</label>
                            <div class="col-md-9">
                                <div class="form-control">
                                    <input type="file" name="image" class="dropify" data-height="200" accept="image/*">
                                    @if(isset($aboutUs->image))
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/about/' . $aboutUs->image) }}" alt="Current Image" width="100">
                                        </div>
                                    @endif
                                    @if($errors->has('image'))
                                        <div class="alert alert-danger mt-1">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                        <!-- Publication Status -->
                        <div class="row">
                            <label for="status" class="col-md-3 form-label">Publication Status</label>
                            <div class="col-md-9 mt-2 p"> 
                                <label>
                                    <input type="radio" value="1" {{ $aboutUs->status == 1 ? 'checked' : '' }} name="status">
                                    <span>Published</span>
                                </label>
                                <label>
                                    <input type="radio" value="0" {{ $aboutUs->status == 0 ? 'checked' : '' }} name="status">
                                    <span>UnPublished</span>
                                </label>
                            </div>
                        </div>
                    
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
@endsection