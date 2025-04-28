@extends('admin.master')

@section('main')


<div class="row mt-5">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Manage Stars</h3>
            </div>
            <div class="card-body">
                @if( session('success') )
                <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if( session('message') )
                <p class="alert alert-success">{{ session('message') }}</p>
                @endif
                @if( session('errorr') )
                <p class="alert alert-success">{{ session('errorr') }}</p>
                @endif
                <div class="table-responsive">
                    <table id="example3" class="table table-bordered text-nowrap border-bottom">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Title</th>
                                <th class="border-bottom-0">Second Title</th>
                                <th class="border-bottom-0">Icon</th>
                                <th class="border-bottom-0">Description</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stars as $star)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $star->title }}</td>
                                <td>{{ $star->second_title }}</td>
                                <td>{{ $star->icon }}</td>
                                <td>{{ $star->description }}</td>
                                <td><img src="{{ asset($star->image) }}" alt="" width="40" height="60"></td>
                                <td>{{ $star->status == 1 ? 'Published' : 'UnPublished' }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('star-edit',$star->id) }}" class="btn btn-success btn-sm me-1">
                                        <i class=" fa fa-edit"></i>
                                    </a>
                                    <form method="post" action="{{ route('star.destroy', $star->id) }}">
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