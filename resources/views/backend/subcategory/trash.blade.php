@extends('backend.master')

@section('subcategory_tree') menu-is-opening menu-open @endsection
@section('subcategory_active') active @endsection
@section('subcategory_trash_active') bg-success @endsection

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
                    <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">Categories</a></li>
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
                        <table class="table table-bordered">

                            <thead>
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
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success"
                                            href="{{ route('subcategory.restore',$subcategory)}}">Restore</a>
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
                    {{-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div> --}}
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
