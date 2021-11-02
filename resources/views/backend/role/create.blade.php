@extends('backend.master')

@section('role_tree') menu-is-opening menu-open @endsection
@section('role_active') active @endsection
@section('role_add_active') bg-success @endsection

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
    <div class="col mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('role.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Role Name" name="name">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="card-body">
                        <h4 class="text-center">Permissions</h4>
                        <hr>
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="form-group col-3">
                                <input type="checkbox" name="permissions[]" id="{{ $permission->id }}"
                                    class=" @error('name') is-invalid @enderror" value="{{ $permission->name }}">
                                <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        @error('permissions')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</section>

@endsection
