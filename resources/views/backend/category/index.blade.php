@extends('backend.master')


@section('category_tree') menu-is-opening menu-open @endsection
@section('category_active') active @endsection
@section('category_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('category.index')}}">Categories</a></li>
                    <li class="breadcrumb-item active">All Category</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Category Table</strong></h3>
                        <a class="float-right" href="{{ route('category.create') }}">
                            <i class="fa fa-plus"> Category</i>
                        </a>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="category_table" class="display compact" style="width: 100%">

                            <thead style="text-transform: uppercase">
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $key => $category)
                                <tr>

                                    <td>{{ $categories->firstItem() + $key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info" href="{{ route('category.show',$category)}}">Details</a>
                                        <a class="btn btn-warning" href="{{ route('category.edit',$category)}}">Edit</a>
                                        <form action="{{route('category.destroy',$category)}}" method="POST"
                                            style="display: inline-block">
                                            @csrf @method("DELETE")
                                            <button type="submit" onclick="return confirm('Are You Sure?')"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No Data Avilable</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $categories->links() }}

                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>


    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
@section('footer_js')
<script>
    $(document).ready( function () {
        $('#category_table').DataTable();
        } );
</script>
@endsection
