@extends('backend.master')

@section('color_size_tree') menu-is-opening menu-open @endsection
@section('color_size_active') active @endsection
@section('size_active') bg-success @endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Subcategory Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('size.index') }}">Size List</a></li>
                    <li class="breadcrumb-item active">Size</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content md-6">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Size Table</strong></h3>
                        <a class="float-right" href="{{ route('size.index') }}">
                            <i class="fa fa-plus"> Size</i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">

                            <thead style="text-transform: uppercase">
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sizes as $key => $size)
                                <tr>

                                    <td>{{ $sizes->firstItem() + $key }}</td>
                                    <td>{{ $size->name }}</td>
                                    <td>{{ $size->created_at->format('d-M-Y') }}
                                        ({{ $size->created_at->diffForHumans() }})</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No Data Avilable</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $sizes->links() }}
                </div>
            </div>
        </div>
    </div>
</section>


<section class="content mt-5 size_form">
    <div class="col-md mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class=" card-title">New Size</h3>
            </div>

            <form id="size_form" method="POST" action="{{ route('size.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Size Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Size name" name="name" value="{{old('name')}}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>

    </div>
</section>
@endsection
