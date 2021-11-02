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
<section class="content">
    <div class="col-md mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <span class="card-title h2 col">Coupon Details</span>
                    <span class="col">
                        <a class="ml-1 btn btn-success float-right small col-sm-1"
                            href="{{ route('coupon.edit',$coupon)}}"><i class="fas fa-edit"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <table class="table table-bordered">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <td class="bg-light" scope="row">Coupon Name:</td>
                        <td>{{$coupon->name}}</td>
                    </tr>
                    <tr>
                        <td class="bg-light" scope="row">Amount %:</td>
                        <td>{{$coupon->amount}} %</td>
                    </tr>
                    <tr>
                        <td class="bg-light" scope="row">Validity :</td>
                        <td>{{$coupon->validity}}</td>
                    </tr>
                    <tr>
                        <td class="bg-light" scope="row">Limit :</td>
                        <td>{{$coupon->limit}} Times Applicable</td>
                    </tr>

                    <tr>
                        <td class="bg-light" scope="row">Created At:</td>
                        <td>{{$coupon->created_at->diffForHumans()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card -->

    </div>
</section>
@endsection
