@extends('backend.master')

@section('product_tree') menu-is-opening menu-open @endsection
@section('product_active') active @endsection
@section('product_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">products</a></li>
                    <li class="breadcrumb-item active">All Product</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- /.container-fluid -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Product Table</strong></h3>
                        <a class="float-right" href="{{ route('product.create') }}">
                            <i class="fa fa-plus"> Product</i>
                        </a>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product_table" class="display compact text-center">

                            <thead class="bg-success text-center" style="text-transform: uppercase">
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($products as $key => $product)
                                <tr>

                                    <td>{{ $products->firstItem() + $key }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('product.show',$product)}}">Details</a>
                                        <a class="btn btn-warning" href="{{ route('product.edit',$product)}}">Edit</a>
                                        <form action="{{route('product.destroy',$product)}}" method="POST"
                                            style="display: inline-block">
                                            @csrf @method("DELETE")
                                            <button type="submit" onclick="return confirm('Are You Sure?')"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50" class="text-danger text-center h1">No Data Avilable</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $products->links() }}

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
        $('#product_table').DataTable();
        } );
</script>
@endsection
