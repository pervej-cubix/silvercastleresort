@extends('admin.master')

@section('main')

<div class="row mt-10 mb-10">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card mt-4">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Add New Content</h3>
                </div>
                <div class="card-body">
                    @if( session('saveMessage') )
                        <p class="alert alert-success">{{ session('saveMessage') }}</p>
                    @endif
                    <form class="form-horizontal" action="{{ route('aboutUs-store') }}" method="post" enctype="multipart/form-data">
                        @csrf                    
                        <!-- Title -->
                        <div class="row mb-4 mt-4">
                            <label for="title" class="col-md-3 form-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" placeholPaboutder="Enter title" required>
                                @if($errors->has('title'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>                    
                        <!-- Description -->
                        <div class="row mb-4">
                            <label for="description" class="col-md-3 form-label">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" rows="5" placeholder="Enter description"></textarea>
                                @if($errors->has('description'))
                                    <div class="alert alert-danger mt-1">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                    
                        <!-- Image -->
                        <div class="row mb-4">
                            <label for="image" class="col-md-3 form-label">Image</label>
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
                        <div class="row">
                            <label for="email" class="col-md-3 form-label">Publication Status</label>
                            <div class="col-md-9 mt-2 p">
                                <label><input type="radio" value="1" checked name="status"><span>Published</span></label>
                                <label><input type="radio" value="0" name="status"><span>UnPublished</span></label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-10 offset-lg-1 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title"> About-us Content Manage</h3>
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
                                <th class="border-bottom-0">Title</th>
                                <th class="border-bottom-0">Description</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($aboutUs as $item) 
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                   
                                    <td>{{$item->title}}</td> 
                                    <td>{{ substr($item->description,0, 50)}}...</td> 
                                    <td>
                                        <img src="{{ asset($item->image) }}" alt="Image" width="40" height="60">
                                    </td>       
                                    <td>{{ $item->status == 1 ? 'Published' : 'UnPublished' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('aboutUs-edit', $item->id) }}" class="btn btn-success btn-sm me-1">
                                            <i class=" fa fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{ route('aboutUs.destroy', $item->id) }}">
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