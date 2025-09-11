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
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Sub Category</h3>
                        </div>

                        
                        <form action="{{ isset($editSubCategory) ? route('admin.update-subcategory') : route('admin.subcategories.store') }}"
                            method="POST"
                            class="needs-validation">
                            @csrf
                            <div class="card-body">
                             <input type="hidden" name="id" value="{{$editSubCategory->id??''}}">
                            
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                     <option value="{{ $category->id }}" 
                                    {{ (isset($editSubCategory) && $editSubCategory->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"  value="{{ $editSubCategory->name ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ $editSubCategory->description ?? '' }}</textarea>
                            </div>

                             <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{ (isset($editSubCategory) && $editSubCategory->status == 'active') ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ (isset($editSubCategory) && $editSubCategory->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                             <button type="submit" class="btn btn-success">
            {{ isset($editSubCategory) ? 'Update' : 'Save' }}
        </button>
                            </div>
                        </form>
                    </div>



                </div>

                <div class="col-md-6">



                    <div class="card card card-info">
                        <div class="card-header ">
                            <h3 class="card-title">Sub Category List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($subcategories as $subcategory)
                                        <tr>
                                            <td>{{ $subcategory->id }}</td>
                                            <td>{{ $subcategory->category->name }}</td>
                                            <td>{{ $subcategory->name }}</td>
                                            <td>{{ $subcategory->description }}</td>
                                            <td> 
                                                <a href="{{ route('admin.subcategories.create', ['edit'=>$subcategory->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-{{$subcategory->status == 'inactive'?'danger':'primary'}}">{{ucfirst($subcategory->status)}}</button>
                                           
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>

            </div>


        </div>
    </section>

</div>

@endsection