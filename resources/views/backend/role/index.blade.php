@extends('backend.master')

@section('role_tree') menu-is-opening menu-open @endsection
@section('role_active') active @endsection
@section('role_view_active') bg-success @endsection

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Role</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active"> Create Role</li>
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
                <h3 class="card-title">New Role</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="role_table" class="display compact" style="width: 100%">

                    <thead style="text-transform: uppercase">
                        <tr>
                            <th style="width: 10px">SL</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $key => $role)
                        <tr>

                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td><a class="btn btn-success" href="{{ route('role.show',$role)}}">Permissions</a></td>
                            <td class="text-center">

                                <a class="btn btn-warning" href="{{ route('role.edit',$role)}}">Edit</a>
                                <form action="{{route('role.destroy',$role)}}" method="POST"
                                    style="display: inline-block">
                                    @csrf @method("DELETE")
                                    <button type="submit" onclick="return confirm('Are You Sure?')"
                                        class="btn btn-danger">Delete</button>
                                </form>
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
        $('#role_table').DataTable();
        } );
</script>
@endsection
