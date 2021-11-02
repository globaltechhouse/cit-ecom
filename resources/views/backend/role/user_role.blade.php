@extends('backend.master')

@section('role_tree') menu-is-opening menu-open @endsection
@section('role_active') active @endsection
@section('role_user_active') bg-success @endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('role.assignUserStore') }}">Categories</a></li>
                    <li class="breadcrumb-item active"> Create User</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="col-md mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('role.assignUserStore') }}">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="user">User</label>
                        <select name="user" id="user" class="form-control @error('user') is-invalid @enderror">
                            <option value="">--Select--</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User With Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="userwithRole_table" class="table compact table-bordered" style="width: 100%">

                    <thead style="text-transform: uppercase">
                        <tr class="text-center bg-success">
                            <th style="width: 10px">SL</th>
                            <th>Users</th>
                            <th>Assigned Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userwithRole as $user)
                        <tr>
                            <td>
                                {{ $loop->index +1 }}
                            </td>
                            <td>
                                <a class="link h4" href="{{ route('profile.index',$user) }}">
                                    <i class="fas fa-user"></i> {{ $user->name }}
                                </a>
                            </td>
                            <td>
                                @foreach ($user->roles as $role)
                                <li>
                                    <a class="h5" href="{{ route('role.show',$role)}}">
                                        {{ $role->name }}
                                    </a>

                                    @if($role->name != "Super Admin")

                                    <a title="Remove" class="text-danger"
                                        href="{{ route('role.revoke',[$role,$user]) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    @endif
                                </li>
                                @endforeach
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

        </div>
        <!-- /.card -->

    </div>
</section>

@endsection
@section('footer_js')
<script>
    $(document).ready( function () {
        $('#userwithRole_table').DataTable();
        } );
</script>
@endsection
