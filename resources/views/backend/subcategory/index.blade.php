@extends('backend.master')


@section('subcategory_tree') menu-is-opening menu-open @endsection
@section('subcategory_active') active @endsection
@section('subcategory_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Subcategory Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">Subcategories</a></li>
                    <li class="breadcrumb-item active">All Subcategory</li>
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
                        <h3 class="card-title"><strong>Subcategory Table</strong></h3>
                        <a class="float-right" href="{{ route('subcategory.create') }}">
                            <i class="fa fa-plus"> Subcategory</i>
                        </a>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="subcategory_table" class="display compact" style="width:100%">

                            <thead style="text-transform: uppercase">
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $key => $subcategory)
                                <tr>

                                    <td>{{ $subcategories->firstItem() + $key }}</td>
                                    <td>
                                        <a class="h6"
                                            href="{{ route('subcategory.show',$subcategory)}}">{{ $subcategory->name }}
                                        </a>
                                    </td>
                                    <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        {{-- <a class="btn btn-info"
                                            href="{{ route('subcategory.show',$subcategory)}}">Details</a> --}}
                                        <a class="btn btn-warning"
                                            href="{{ route('subcategory.edit',$subcategory)}}">Edit</a>
                                        <form action="{{route('subcategory.destroy',$subcategory)}}" method="POST"
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
                    {{ $subcategories->links() }}

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
        $('#subcategory_table').DataTable();
        } );
</script>
@endsection
