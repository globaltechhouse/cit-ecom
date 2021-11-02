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
                    <li class="breadcrumb-item active">All Product</li>
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
                    <span class="card-title h2 col">Product Details</span>
                    <span class="col">
                        <a class="ml-1 btn btn-success float-right small col-sm-1"
                            href="{{ route('product.edit',$product)}}"><i class="fas fa-edit"></i>
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
                        <td class="col-2 text-bold text-primary" scope="row">Product Name: </td>
                        <td class="text-bold h4">{{$product->name}}
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2 text-bold text-primary" scope="row">Category: </td>
                        <td>{{$product->category->name}}</td>
                    </tr>

                    <tr>
                        <td class="col-2 text-bold text-primary" scope="row">Subcategory:</td>
                        <td>{{$product->subcategory->name}}</td>
                    </tr>
                    <tr>
                        <td class="col-2 text-bold text-primary" scope="row">Thumbnail</td>
                        <td>
                            <img src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/') . $product->id . '/'.$product->thumbnail) }}"
                                alt="{{$product->name}}" width="100">
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2 text-bold text-primary" scope="row">Summery:</td>
                        <td>{{$product->summery}}</td>
                    </tr>
                    <tr>
                        <td class="col-2 text-bold text-primary" scope="row">Description:</td>
                        <td>{{$product->description}}</td>
                    </tr>
                    <tr>
                        <td class="col-2 text-bold text-primary" scope="row">Variables:</td>
                        <td>
                            @foreach ($product->varibales as $variable)
                            <ol>
                                <i><b>{{ $loop->index+1 }}.</b>
                                    Color: {{$variable->color->name}}, Size: {{ $variable->size->name }}, Available:
                                    {{ $variable->quantity }}, Regular Price: <s>{{ $variable->regular_price }},</s>
                                    Offer
                                    Price: {{ $variable->offer_price }}.
                                </i>
                            </ol>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2 text-bold" scope="row">Created:</td>
                        <td>{{$product->created_at->diffForHumans()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</section>
<style>
    .btn:focus,
    .btn:active,
    button:focus,
    button:active {
        outline: none !important;
        box-shadow: none !important;
    }

    #image-gallery .modal-footer {
        display: block;
    }

    .thumb {
        margin-top: 15px;
        margin-bottom: 15px;
    }
</style>
<section class="content">
    <div class="col-md mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Gallary</h3>
            </div>
            <!-- /.card-header -->

            <div class="container">
                <div class="row">
                    <div class="row">
                        @foreach ($product->photos as $photo)
                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <div class="thumbnail" href="#" data-image-id="{{ $photo->id }}" data-toggle="modal"
                                data-title=""
                                data-image="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.'gallery/'.$photo->name) }}"
                                data-target="#image-gallery">
                                <img class="img-thumbnail"
                                    src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.'gallery/'.$photo->name) }}"
                                    alt="{{ $photo->name }}"><br>
                                <div class="text-center"><a href="{{ route('destroy.gallery',[$product,$photo]) }}"><i
                                            class="fas fa-trash"></i></a></div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('footer_js')
<script>
    let modalId = $('#image-gallery');

    $(document)
    .ready(function () {

        loadGallery(true, 'a.thumbnail');

        //This function disables buttons when needed
        function disableButtons(counter_max, counter_current) {
        $('#show-previous-image, #show-next-image')
            .show();
        if (counter_max === counter_current) {
            $('#show-next-image')
            .hide();
        } else if (counter_current === 1) {
            $('#show-previous-image')
            .hide();
        }
        }

        /**
        *
        * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
        * @param setClickAttr  Sets the attribute for the click handler.
        */

        function loadGallery(setIDs, setClickAttr) {
        let current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image')
            .click(function () {
            if ($(this)
                .attr('id') === 'show-previous-image') {
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
            });

        function updateGallery(selector) {
            let $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-title')
            .text($sel.data('title'));
            $('#image-gallery-image')
            .attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if (setIDs == true) {
            $('[data-image-id]')
            .each(function () {
                counter++;
                $(this)
                .attr('data-image-id', counter);
            });
        }
        $(setClickAttr)
            .on('click', function () {
            updateGallery($(this));
            });
        }
    });

    // build key actions
    $(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

</script>

@endsection
