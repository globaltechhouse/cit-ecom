@extends('backend.master')


@section('coupon_tree') menu-is-opening menu-open @endsection
@section('coupon_active') active @endsection
@section('coupon_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Coupon Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('coupon.index')}}">Coupons</a></li>
                    <li class="breadcrumb-item active">All Coupon</li>
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
                        <h3 class="card-title"><strong>Coupon Table</strong></h3>
                        <a class="float-right" href="{{ route('coupon.create') }}">
                            <i class="fa fa-plus"> Coupon</i>
                        </a>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="coupon_table" class="display compact text-center" style="width:100%">

                            <thead style="text-transform: uppercase">
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Validity</th>
                                    <th>Limit</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $key => $coupon)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <a class="h6" href="{{ route('coupon.show',$coupon)}}">{{ $coupon->name }}
                                        </a>
                                    </td>
                                    <td>{{ $coupon->amount }}</td>
                                    <td>{{ $coupon->validity }}</td>
                                    <td>{{ $coupon->limit }}</td>
                                    <td>{{ $coupon->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('coupon.show',$coupon)}}">Details</a>
                                        <a class="btn btn-warning" href="{{ route('coupon.edit',$coupon)}}">Edit</a>
                                        <form action="{{route('coupon.destroy',$coupon)}}" method="POST"
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
        $('#coupon_table').DataTable();
        } );
</script>
@endsection
