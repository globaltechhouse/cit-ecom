@extends('backend.master')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ (asset('profile/'. $profile->id . '/'.$profile->image)) ?? '' }}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $profile->user->name }}</h3>

                        <p class="text-muted text-center">{{ $profile->user->roles->first()->name ?? '' }}</p>
                        <p class="text-muted text-center">Joining Date:
                            {{ $profile->created_at->format('d F, Y') ?? '' }}
                        </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <span class="card-title h3">About
                            {{ ($profile->user->id == auth()->id()) ? 'Me' : $profile->user->name }} </span>
                        @if ($profile->user->id == auth()->id())
                        <a href="{{ route('profile.create') }}" class="float-right"><i class="fas fa-edit"></i></a>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-mobile mr-1"></i> Mobile No.</strong>

                        <p class="text-muted">
                            <a href="tel:{{ $profile->mobile_no }}">{{ $profile->mobile_no }}</a>

                        </p>

                        <hr>
                        <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                        <p><a href="mailto:{{ $profile->user->email }}" class="text-muted">
                                {{ $profile->user->email }}
                            </a>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                        <address class="text-muted">{{ $profile->address }}</address>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Roles</strong>

                        <p class="text-muted">
                            @foreach ($profile->user->roles as $role)
                            <span class="mr-1 tag">{{ $role->name }}</span>
                            @endforeach
                        </p>

                        <hr>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
