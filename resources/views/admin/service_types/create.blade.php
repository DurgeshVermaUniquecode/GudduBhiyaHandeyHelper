@extends('layout.adminLayout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Add/Edit Form -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($editServiceType) ? 'Edit Service Type' : 'Add Service Type' }}</h3>
                        </div>

                        <form action="{{ isset($editServiceType) ? route('admin.update-service-types') : route('admin.service-types.store') }}"
                            method="POST" class="needs-validation">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editServiceType->id ?? '' }}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $editServiceType->name ?? '' }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $editServiceType->description ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active" {{ (isset($editServiceType) && $editServiceType->status == 'active') ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ (isset($editServiceType) && $editServiceType->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($editServiceType) ? 'Update' : 'Save' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- List of Service Types -->
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Service Type List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($serviceTypes as $type)
                                    <tr>
                                        <td>{{ $type->id }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->description }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.service-types.create', ['edit' => $type->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                                            <!-- Delete Form with Confirmation -->
                                            <form action="{{ route('admin.service-types.destroy', $type->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                             <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-{{$type->status == 'inactive'?'danger':'primary'}}">{{ucfirst($type->status)}}</button>
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
    </section>
</div>

@endsection