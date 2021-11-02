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
                <h1>Billing details</h1>
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
<section class="content">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-md">
                <div class="card bg-warning">
                    <div class="card-header">
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <h3 class="alert alert-primary">Billing Detail</h3>
                            <table class=" table table-border table-primary text-bold">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">Name:</td>
                                        <td>{{$billing->name}}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Email:</td>
                                        <td>{{$billing->email}}</td>
                                    </tr>

                                    <tr>
                                        <td scope="row"> Address:</td>
                                        <td>{{$billing->address}}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">City:</td>
                                        <td>{{$billing->address}}, {{getGeoName($billing->thana).',
                                            '.getGeoName($billing->district).', '.getGeoName($billing->city).'.'}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Order Date:</td>
                                        <td>{{$billing->created_at->format('d F, Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Total Bill:</td>
                                        <td>{{$billing->amount->grand_total}} taka</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h3 class="alert alert-primary text-center">Odered Products</h3>
                        <table id="order_table" class="display compact text-center" style="width: 100%">

                            <thead style="text-transform: uppercase" class="bg-success">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($billing->amount->products as $product)
                                <tr>
                                    <td><a
                                            href="{{ route('front.product.details',[$product->product->slug,$product->product]) }}">
                                            <img class="img-responsive ml-15px"
                                                src="{{ asset('thumbnail/'.$product->product->created_at->format('Y/M/').$product->product->id.'/'.$product->product->thumbnail) }}"
                                                alt="" width="70" /></a></td>
                                    <td>
                                        <a
                                            href="{{ route('front.product.details',[$product->product->slug,$product->product]) }}">{{ $product->product->name }}</a>
                                        <br><span>
                                            Color: {{ $product->color->name }}, Size: {{ $product->size->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="amount">
                                            @php
                                            $price=
                                            price($product->product_id,$product->color_id,$product->size_id)->offer_price
                                            ??
                                            price($product->product_id,$product->color_id,$product->size_id)->regular_price;
                                            @endphp
                                            {{ $price }}
                                        </span>
                                        <span> Tk.</span>
                                    </td>
                                    <td>
                                        {{ $product->quantity }}
                                    </td>
                                </tr>

                                @empty

                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                @endforelse
                            </tbody>
                            {{-- <tfoot style="text-transform: uppercase" class="bg-success">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total(Taka)</th>
                                </tr>
                            </tfoot> --}}
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

@endsection
