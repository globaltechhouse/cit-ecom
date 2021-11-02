@extends('backend.master')

@section('role_tree') menu-is-opening menu-open @endsection
@section('role_active') active @endsection
@section('role_add_new_admin_active') bg-success @endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Role</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active"> Create Role</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="col-md mx-auto">
        <!-- general form elements -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">New Admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('role.store.admin') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Admin Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Admin Name" name="name">
                    </div>
                    @error('name')
                    <div class="alert alert-success">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="Email" name="email">
                    </div>
                    @error('email')
                    <div class="alert alert-success">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="">--Select--</option>
                            @foreach ($roles as $role)
                            @if($role->name == "Super Admin" && !auth()->user()->hasrole("Super Admin"))
                            @continue
                            @else
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('role')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</section>

@endsection
