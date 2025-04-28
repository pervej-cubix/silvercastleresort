@extends('admin.master')

@section('main')

<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4">
                <div class="card-header border-bottom">
                    <h3 class="card-title mb-4 fw-bold">Add Testimonial</h3>
                </div>
                <div class="card-body">
                    @if( session('saveMessage') )
                        <p class="alert alert-success">{{ session('saveMessage') }}</p>
                    @endif
                    <form class="form-horizontal p-4 border rounded shadow-sm" action="{{ route('testimonial-store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    
                    
                        <!-- Name -->
                        <div class="mb-3 row">
                            <label for="name" class="col-md-3 col-form-label">Full Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Company -->
                        <div class="mb-3 row">
                            <label for="company" class="col-md-3 col-form-label">Company</label>
                            <div class="col-md-9">
                                <input type="text" name="company" class="form-control" placeholder="Company name (optional)">
                            </div>
                        </div>
                    
                        <!-- Designation -->
                        <div class="mb-3 row">
                            <label for="designation" class="col-md-3 col-form-label">Designation</label>
                            <div class="col-md-9">
                                <input type="text" name="designation" class="form-control" placeholder="Ex: CEO, Developer">
                            </div>
                        </div>
                    
                        <!-- Message -->
                        <div class="mb-3 row">
                            <label for="message" class="col-md-3 col-form-label">Message</label>
                            <div class="col-md-9">
                                <textarea name="message" class="form-control" rows="4" placeholder="Write testimonial message here..." required></textarea>
                                @error('message')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Image -->
                        <div class="mb-3 row">
                            <label for="image" class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-9">
                                <input type="file" name="image" class="dropify form-control" data-height="200" accept="image/*">
                                @if(isset($testimonial->image))
                                    <div class="mt-2">
                                        <img src="{{ asset('uploads/about/' . $testimonial->image) }}" width="100" alt="Current Image">
                                    </div>
                                @endif
                                @error('image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Status -->
                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Publication Status</label>
                            <div class="col-md-9 d-flex gap-4 align-items-center">
                                <div>
                                    <input type="radio" id="published" value="1" name="status" checked>
                                    <label for="published">Published</label>
                                </div>
                                <div>
                                    <input type="radio" id="unpublished" value="0" name="status">
                                    <label for="unpublished">Unpublished</label>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Submit -->
                        <div class="text-end">
                            <button class="btn btn-primary px-4" type="submit">Submit</button>
                        </div>
                    </form>
                                     
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Testimonial Content Manage</h3>
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
                                <th class="border-bottom-0">FullName</th>
                                <th class="border-bottom-0">Company</th>
                                <th class="border-bottom-0">Designation</th>
                                <th class="border-bottom-0">Message</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($testimonial as $item) 
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                   
                                    <td>{{$item->name}}</td> 
                                    <td>{{$item->company}}</td> 
                                    <td>{{$item->designation}}</td>
                                    <td>{{ substr($item->message,0, 30)}}...</td> 

                                    <td>
                                        <img src="{{ asset($item->image) }}" alt="Image" width="40" height="60">
                                    </td>       
                                    <td>{{ $item->status == 1 ? 'Published' : 'UnPublished' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('testimonial-edit', $item->id) }}" class="btn btn-success btn-sm me-1">
                                            <i class=" fa fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{ route('testimonial.destroy', $item->id) }}">
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