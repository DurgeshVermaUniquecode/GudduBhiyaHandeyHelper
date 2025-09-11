@extends('layout.adminLayout')
@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Service List</h3>
                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm float-right">Add Service</a>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Service Type</th>
                                        <th>Price (₹)</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $key => $service)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            @if($service->image)
                                                <img src="{{ asset($service->image) }}" width="50" height="50" class="img-thumbnail">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $service->title }}</td>
                                        <td>{{ $service->category->name ?? '-' }}</td>
                                        <td>{{ $service->subcategory->name ?? '-' }}</td>
                                        <td>{{ $service->serviceType->name ?? '-' }}</td>
                                        <td>₹{{ number_format($service->base_price,2) }}</td>
                                        <td>
                                            <span class="badge {{ $service->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                                {{ ucfirst($service->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $service->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.services.edit',$service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            
                                            <form action="{{ route('admin.services.destroy',$service->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')

                                                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-{{$service->status == 'inactive'?'danger':'primary'}}">{{ucfirst($service->status)}}</button>
                                           
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No services found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
