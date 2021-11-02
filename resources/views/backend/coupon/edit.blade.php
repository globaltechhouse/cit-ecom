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
                    <li class="breadcrumb-item"><a href="{{route('coupon.index')}}">Coupon</a></li>
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
                <h3 class="card-title">{{ $coupon->name }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('coupon.update',$coupon) }}">
                @csrf @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" required value="{{ $coupon->name }}"><br>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <label for="amount">Amount %</label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                                name="amount" required value="{{ $coupon->amount }}"><br>
                            @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="validity">Validity</label>
                            <input type="date" class="form-control @error('validity') is-invalid @enderror"
                                id="validity" name="validity" required value="{{ $coupon->validity }}"><br>
                            @error('validity')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <label for="limit">Limit</label>
                            <input type="number" class="form-control @error('limit') is-invalid @enderror" id="limit"
                                name="limit" required value="{{ $coupon->limit }}"><br>
                            @error('limit')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</section>
@endsection
