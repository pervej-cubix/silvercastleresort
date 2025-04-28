@extends('admin.master')

@section('main')

<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4"> 
                <div class="card-header border-bottom">
                    <h3 class="card-title">Update Testimonial</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('testimonial-update', $testimonial->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        <!-- Name -->
                        <div class="row mb-4 mt-4">
                            <label for="name" class="col-md-3 form-label">Full Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" placeholder="Enter full name" required>
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Company -->
                        <div class="row mb-4">
                            <label for="company" class="col-md-3 form-label">Company</label>
                            <div class="col-md-9">
                                <input type="text" name="company" class="form-control" value="{{ old('company', $testimonial->company) }}" placeholder="Enter company name">
                                @error('company')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Designation -->
                        <div class="row mb-4">
                            <label for="designation" class="col-md-3 form-label">Designation</label>
                            <div class="col-md-9">
                                <input type="text" name="designation" class="form-control" value="{{ old('designation', $testimonial->designation) }}" placeholder="Enter designation">
                                @error('designation')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Message -->
                        <div class="row mb-4">
                            <label for="message" class="col-md-3 form-label">Message</label>
                            <div class="col-md-9">
                                <textarea name="message" class="form-control" rows="5" placeholder="Enter testimonial message" required>{{ old('message', $testimonial->message) }}</textarea>
                                @error('message')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Image -->
                        <div class="row mb-4">
                            <label for="image" class="col-md-3 form-label">Image</label>
                            <div class="col-md-9">
                                <input type="file" name="image" class="dropify form-control" data-height="200" accept="image/*">
                                @if(isset($testimonial->image))
                                    <div class="mt-2">
                                        <img src="{{ asset('uploads/about/' . $testimonial->image) }}" alt="Current Image" width="100">
                                    </div>
                                @endif
                                @error('image')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Status -->
                        <div class="row mb-4">
                            <label for="status" class="col-md-3 form-label">Publication Status</label>
                            <div class="col-md-9 mt-2">
                                <label>
                                    <input type="radio" value="1" name="status" {{ $testimonial->status == 1 ? 'checked' : '' }}>
                                    <span>Published</span>
                                </label>
                                <label class="ms-4">
                                    <input type="radio" value="0" name="status" {{ $testimonial->status == 0 ? 'checked' : '' }}>
                                    <span>UnPublished</span>
                                </label>
                            </div>
                        </div>                    
                        <div class="text-end">
                            <button class="btn btn-primary px-4" type="submit">Update</button>
                        </div>
                    </form>                                       
                </div>
            </div>
        </div>
    </div>
@endsection