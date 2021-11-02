@extends('backend.master')

@section('role_tree') menu-is-opening menu-open @endsection
@section('role_active') active @endsection
@section('role_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Role Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('role.index')}}">Role</a></li>
                    <li class="breadcrumb-item active">All Role</li>
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
                    <span class="card-title h2 col">Role Details</span>
                    <span class="col">
                        <a class="ml-1 btn btn-success float-right small col-sm-1"
                            href="{{ route('role.edit',$role)}}"><i class="fas fa-edit"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <h4 class="display-4 text-center">{{ $role->name }}</h4>
            <div class="row m-3">
                @foreach ($role->permissions as $permission)
                <div class="col-3">
                    <hr>
                    <li>{{ $permission->name }}</li>
                </div>
                @endforeach
            </div>


        </div>
        <!-- /.card -->

    </div>
</section>

@endsection
