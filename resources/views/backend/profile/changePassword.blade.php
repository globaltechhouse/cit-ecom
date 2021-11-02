@extends('backend.master')


<!-- Content Header (Page header) -->
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profile</a></li>
                    <li class="breadcrumb-item active"> Create Profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="col-md-6 mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Profile</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('profile.update.password',$user) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="card-body">
                    @if ($user->registration_method == 'local')
                    <div class="form-group">
                        <label for="old_password">Password..</label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                            id="old_password" placeholder="Old Password" name="old_password">
                        @if(!empty(session('old_password')))
                        <div class="alert alert-danger">{{ session('old_password') }}</div>
                        @endif
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="password">New Password..</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Password" name="password">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmed">New Password..</label>
                        <input type="password" class="form-control @error('confirmed') is-invalid @enderror"
                            id="confirmed" placeholder="Confirmed Password" name="confirmed">
                        @error('confirmed')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer password-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</section>

@endsection
