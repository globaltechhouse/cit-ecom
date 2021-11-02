@extends('backend.master')


@section('order_tree') menu-is-opening menu-open @endsection
@section('order_active') active @endsection
@section('order_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Order Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('order.index')}}">Orders</a></li>
                    <li class="breadcrumb-item active">All Order</li>
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
                        <h3 class="card-title"><strong>Order Table</strong></h3>
                        <a class="float-right" href="#">
                            <i class="fa fa-plus"> Order</i>
                        </a>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="order_table" class="display compact text-center" style="width: 100%">

                            <thead style="text-transform: uppercase" class="bg-success">
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Order Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($billings as $key => $billing)
                                <tr>

                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $billing->name }}</td>
                                    <td>{{ $billing->amount->grand_total }} Tk.</td>
                                    <td>{{ $billing->created_at->format('d F, Y') }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info" href="{{ route('order.details',$billing)}}">Details</a>
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
        $('#order_table').DataTable();
        } );
</script>
@endsection
