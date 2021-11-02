@extends('backend.master')

@section('product_tree') menu-is-opening menu-open @endsection
@section('product_active') active @endsection
@section('product_view_active') bg-success @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $product->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a></li>
                    <li class="breadcrumb-item active">edit {{ $product->name }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="col mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title text-uppercase">New Product </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('product.update',$product) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Product Name **</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Product Name" name="name" value="{{ $product->name }}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col form-group">
                            <label for="thumbnail" class="form-lebel"> Thumbnail ** </label>
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                id="thumbnail" name="thumbnail"
                                onchange="document.getElementById('thumbnail_preview').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        @error('thumbnail')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col form-group">
                            <img id="thumbnail_preview"
                                src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.$product->thumbnail) }}"
                                alt="" width="100">
                        </div>

                    </div>
                    <div hidden class="form-group">
                        <label for="slug"> Slug </label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                            placeholder="Slug" name="slug" value="{{ $product->slug }}">
                    </div>
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="form-group col">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id"
                                class="form-select form-control @error('category_id') is-invalid @enderror">
                                <option value="">--Select--</option>
                                @foreach ($categories as $category)
                                <option @if ($product->category_id == $category->id) selected @endif
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="subcategory_id">SubCategory</label>
                            <select name="subcategory_id" id="subcategory_id"
                                class="form-select form-control @error('subcategory_id') is-invalid @enderror">
                                <option value="">--Select--</option>
                                @foreach ($subcategories as $subcategory)
                                <option @if($product->subcategory_id == $subcategory->id) selected @endif
                                    value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error('subcategory_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summery">Summery</label>
                        <input type="text" class="form-control @error('summery') is-invalid @enderror" id="summery"
                            placeholder="Summery" name="summery" value="{{ $product->summery }}">
                    </div>
                    @error('summery')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description">{{ $product->description }}</textarea>
                    </div>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-3 form-group">
                            <label for="gallery" class="form-lebel"> Gallery ** </label>
                            <input type="file" class="form-control @error('gallery') is-invalid @enderror" id="gallery"
                                name="gallery[]" multiple>
                            @if(session('gallery_error'))
                            <div class="alert alert-danger">{{ session('gallery_error') }}</div>
                            @endif
                        </div>
                        <label class="row">Gallery Images: **</label>
                        @foreach ($product->photos as $photo)
                        <div class="col-2 text-center thumbnail"><br>
                            <img src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.'gallery/'.$photo->name) }}"
                                alt="{{ $photo->name }}" width="50"><br>
                            <a href="{{ route('destroy.gallery',[$product,$photo]) }}"><i class="fas fa-trash"></i></a>
                        </div>
                        @endforeach
                    </div>
                    {{-- Edit Section Start  --}}
                    @foreach($product->varibales as $variable)
                    <div class="row">
                        <div class="col form-group">
                            <label for="color_id">Color</label>
                            <input type="text" name="id[]" value="{{ $variable->id }}" hidden>
                            {{-- <input type="text" name="id[]" value="{{ $variable->id }}" hidden> --}}
                            <select name="color_id[]" id="color_id" class="form-control">
                                <option value>Select</option>
                                @foreach ($colors as $color)
                                <option @if ($variable->color_id == $color->id) selected @endif
                                    value="{{$color->id}}">{{$color->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="size_id">Size</label>
                            <select name="size_id[]" id="size_id" class="form-control">
                                <option value>Select</option>
                                @foreach ($sizes as $size)
                                <option @if ($variable->size_id == $size->id) selected @endif
                                    value="{{$size->id}}">{{$size->name}}</option>
                                @endforeach
                            </select>
                            @error("size_id[]")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <label for="">Quantity</label>
                            <input type="text" name="quantity[]" class="form-control" value="{{ $variable->quantity }}">
                            @error("quantity[]")
                            <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <label for="">Regula Price</label>
                            <input type="text" name="regular_price[]" class="form-control"
                                value="{{ $variable->regular_price }}">
                            @error("regular_price[]")
                            <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <label for="">Offer Price <span class="small">(if Available)</span></label>
                            <input type="text" name="offer_price[]" class="form-control"
                                value="{{ $variable->offer_price }}">
                            @error("sale_price[]")
                            <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    @endforeach
                    {{-- Edit Section End --}}

                    {{-- New Variable Start --}}
                    <div id="dynamic-field-1" class="form-group dynamic-field">
                        <div class="row">
                            <div class="col form-group">
                                <label for="color_id">Color</label>
                                <select name="color_id[]" id="color_id" class="form-control">
                                    <option value>Select</option>
                                    @foreach ($colors as $color)
                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                    @endforeach
                                </select>
                                <br>@error("color_id[]")
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="size_id">Size</label>
                                <select name="size_id[]" id="size_id" class="form-control">
                                    <option value>Select</option>
                                    @foreach ($sizes as $size)
                                    <option value="{{$size->id}}">{{$size->name}}</option>
                                    @endforeach
                                </select>
                                <br>@error("size_id[]")
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="">Quantity</label>
                                <input type="text" name="quantity[]" class="form-control" value="">
                                <br>@error("quantity[]")
                                <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col form-group">
                                <label for="">Regula Price</label>
                                <input type="text" name="regular_price[]" class="form-control" value="">
                                <br>@error("regular_price[]")
                                <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="">Offer Price <span class="small">(if Available)</span></label>
                                <input type="text" name="offer_price[]" class="form-control" value="">
                                <br>@error("offer_price[]")
                                <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- New Variable End --}}
                    <div class="clearfix mt-4">
                        <button type="button" id="add-button"
                            class="btn btn-secondary float-left text-uppercase shadow-sm"><i
                                class="fas fa-plus fa-fw"></i> Add </button>
                        <button type="button" id="remove-button"
                            class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i
                                class="fas fa-minus fa-fw"></i> Remove </button>
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
@section('footer_js')
<script>
    $(document).ready(function(){
        $("#category_id").change(function(){
            var category_id = $("#category_id").val();
            // alert(category_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'post',
                url:'/get/subcategory',
                data:{category_id: category_id},
                success: function(res){
                    // alert(res);
                    $("#subcategory_id").empty();
                    $("#subcategory_id").append('<option value="">--Select--</option>');
                    let options = "";
                    $.each(res,function (key,value) {
                    options += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    $("#subcategory_id").append(options);
                }
            });
        });


        $('#name').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        var buttonAdd = $("#add-button");
        var buttonRemove = $("#remove-button");
        var className = ".dynamic-field";
        var count = {{ $product->varibales->count() }};
        var field = "";
        var maxFields = count + 5;

        function totalFields() {
            return $(className).length;
        }

        function addNewField() {
            count = totalFields() + 1;
            field = $("#dynamic-field-1").clone();
            field.attr("id", "dynamic-field-" + count);
            field.children("label").text("Field " + count);
            field.find("input").val("");
            $(className + ":last").after($(field));
        }

        function removeLastField() {
            if (totalFields() > 1) {
                $(className + ":last").remove();
            }
        }

        function enableButtonRemove() {
            if (totalFields() === 2) {
                buttonRemove.removeAttr("disabled");
                buttonRemove.addClass("shadow-sm");
            }
        }

        function disableButtonRemove() {
            if (totalFields() === 1) {
                buttonRemove.attr("disabled", "disabled");
                buttonRemove.removeClass("shadow-sm");
            }
        }

        function disableButtonAdd() {
            if (totalFields() === maxFields) {
                buttonAdd.attr("disabled", "disabled");
                buttonAdd.removeClass("shadow-sm");
            }
        }

        function enableButtonAdd() {
            if (totalFields() === (maxFields - 1)) {
                buttonAdd.removeAttr("disabled");
                buttonAdd.addClass("shadow-sm");
            }
        }

        buttonAdd.click(function() {
            addNewField();
            enableButtonRemove();
            disableButtonAdd();
        });

        buttonRemove.click(function() {
            removeLastField();
            disableButtonRemove();
            enableButtonAdd();
        });

    });
</script>
@endsection
