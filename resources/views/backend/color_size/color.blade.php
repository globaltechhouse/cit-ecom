@extends('backend.master')

@section('color_size_tree') menu-is-opening menu-open @endsection
@section('color_size_active') active @endsection
@section('color_active') bg-success @endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Subcategory Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('color.index')}}">Color List</a></li>
                    <li class="breadcrumb-item active">Color</li>
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
                        <h3 class="card-title"><strong>Color Table</strong></h3>
                        <a class="float-right" href="{{ route('color.index') }}">
                            <i class="fa fa-plus"> Color</i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">

                            <thead style="text-transform: uppercase">
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Color Name</th>
                                    <th>Created At</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($colors as $key => $color)
                                <tr>

                                    <td>{{ $colors->firstItem() + $key }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->created_at->format('d-M-Y ') }}
                                        ({{ $color->created_at->diffForHumans() }})</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No Data Avilable</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $colors->links() }}
                </div>
            </div>
        </div>
    </div>
</section>


<section class="content mt-5">
    <div class="col-md mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Color</h3>
            </div>

            <form method="POST" id="color_form" action="{{ route('color.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Color Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Color name" name="name" value="{{old('name')}}">
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
