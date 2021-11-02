@extends('backend.master')

@section('category_tree') menu-is-opening menu-open @endsection
@section('category_active') active @endsection
@section('category_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('category.index')}}">Categories</a></li>
                    <li class="breadcrumb-item active">All Category</li>
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
                    <span class="card-title h2 col">Category Details</span>
                    <span class="col">
                        <a class="ml-1 btn btn-success float-right small col-sm-1"
                            href="{{ route('category.edit',$category)}}"><i class="fas fa-edit"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <table class=" table border">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Category Name:</td>
                        <td>{{$category->name}}</td>
                    </tr>
                    <tr>
                        <td scope="row">Slug:</td>
                        <td>{{$category->slug}}</td>
                    </tr>

                    <tr>
                        <td scope="row">Created At:</td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card -->

    </div>
</section>

@endsection
