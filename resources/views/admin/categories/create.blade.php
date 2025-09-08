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

                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Category</h3>
                        </div>

                        <form  action="{{ isset($editCategory) ? route('admin.update-category') : route('admin.categories.store') }}" 
    method="POST"
    class="needs-validation" >
                          
                        <input type="hidden" name="id" value="{{$editCategory->id??''}}">
                        
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{ $editCategory->name ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $editCategory->description ?? '' }}</textarea>
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



                    <div class="card card card-info">
                        <div class="card-header ">
                            <h3 class="card-title">Category List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $cat)
                                    <tr>
                                        <td>{{ $cat->id }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.create',['edit'=>$cat->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.categories.destroy',$cat->id) }}" method="POST" style="display:inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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