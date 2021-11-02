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
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Full Name" name="name" value="{{ $profile->user->name }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Email..</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="Email" name="email" value="{{ $profile->user->email }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="">Gender..</label><br>
                        <label for="male">Male</label>
                        <input @if($profile->gender == "male") checked @endif type="radio" class="mr-3 @error('gender')
                        is-invalid @enderror" id="male" name="gender"
                        value="male">
                        <label for="female">Female</label>
                        <input @if($profile->gender == "female") checked @endif type="radio" class="@error('gender')
                        is-invalid @enderror" id="female" name="gender"
                        value="female">
                        @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mobile_no">Mobile No..</label>
                        <input type="tel" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no"
                            placeholder="017XXXXXXXX" name="mobile_no" value="{{ $profile->mobile_no }}">
                        @error('mobile_no')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <i class="fas fa-map-marker-alt mr-2"></i><label for="address">Address..</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            placeholder="#12,Manik miya Avenue, Sher A bangla Nagar, Dhaka" name="address"
                            value="{{ $profile->address }}">
                        @error('address')
                        <div class=" alert alert-danger">{{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Images..</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
