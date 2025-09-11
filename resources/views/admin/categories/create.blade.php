@extends('layout.adminLayout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($editCategory) ? 'Edit Category' : 'Create Category' }}</h3>
                        </div>

                        <form 
                            action="{{ isset($editCategory) ? route('admin.update-category') : route('admin.categories.store') }}" 
                            method="POST"
                            enctype="multipart/form-data"
                            class="needs-validation">

                            @csrf
                            <input type="hidden" name="id" value="{{ $editCategory->id ?? '' }}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $editCategory->name ?? '' }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $editCategory->description ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Category Image</label>
                                    <input type="file" name="category_image" class="form-control">
                                    @if(isset($editCategory) && $editCategory->category_image)
                                        <img src="{{ asset($editCategory->category_image) }}" width="80" class="mt-2">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{ (isset($editCategory) && $editCategory->status == 'active') ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ (isset($editCategory) && $editCategory->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($editCategory) ? 'Update' : 'Save' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header ">
                            <h3 class="card-title">Category List</h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $cat)
                                    <tr>
                                        <td>{{ $cat->id }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            @if($cat->category_image)
                                                <img src="{{ asset($cat->category_image) }}" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.categories.create', ['edit' => $cat->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display:inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')"  class="btn btn-sm btn-{{$cat->status == 'inactive'?'danger':'primary'}}">{{ucfirst($cat->status)}}</button>
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
