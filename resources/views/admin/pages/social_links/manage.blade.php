@extends('admin.master')

@section('main')


<div class="row mt-5">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title"> Accommodation Manage</h3>
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
                                <th class="border-bottom-0">Mobile</th>
                                <th class="border-bottom-0">Map Link</th>
                                <th class="border-bottom-0">Facebook Link</th>
                                <th class="border-bottom-0">Instagram Link</th>
                                <th class="border-bottom-0">Youtube Link</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($social_links as $social_link)
                            
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $social_link->mobile }}</td>
                                    <td>{{ $social_link->map_link }}</td>
                                    <td>{{ $social_link->fb_link }}</td>
                                    <td>{{ $social_link->instagram_link }}</td>
                                    <td>{{ $social_link->youtube_link }}</td>
                                    <td>{{ $social_link->whatsapp_link }}</td>
                                    
                                    <td>{{ $social_link->status == 1 ? 'Published' : 'UnPublished' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('social-edit',$social_link->id) }}" class="btn btn-success btn-sm me-1">
                                            <i class=" fa fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{ route('social.destroy', $social_link->id) }}">
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