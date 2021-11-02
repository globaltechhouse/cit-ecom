@extends('backend.master')


@section('subcategory_tree') menu-is-opening menu-open @endsection
@section('subcategory_active') active @endsection
@section('subcategory_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $subcategory->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">Subcategories</a></li>
                    <li class="breadcrumb-item active">All Subcategory</li>
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
                    <span class="card-title h2 col">Subcategory Details</span>
                    <span class="col">
                        <a class="ml-1 btn btn-success float-right small col-sm-1"
                            href="{{ route('subcategory.edit',$subcategory)}}"><i class="fas fa-edit"></i>
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
                        <td class="bg-light" scope="row">Subcategory Name:</td>
                        <td>{{$subcategory->name}}</td>
                    </tr>
                    <tr>
                        <td class="bg-light" scope="row">Slug:</td>
                        <td>{{$subcategory->slug}}</td>
                    </tr>
                    <tr>
                        <td class="bg-light" scope="row">Under Category:</td>
                        <td>{{$subcategory->Category->name}}</td>
                    </tr>

                    <tr>
                        <td class="bg-light" scope="row">Created At:</td>
                        <td>{{$subcategory->created_at->diffForHumans()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card -->

    </div>
</section>

@endsection
