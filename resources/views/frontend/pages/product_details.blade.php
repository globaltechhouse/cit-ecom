@extends('frontend.master')
@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">{{ $product->name }}</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Product Details Area Start -->
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto"
                                src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.$product->thumbnail) }}"
                                alt="">
                        </div>
                        @foreach ($product->photos as $photo)
                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto"
                                src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.'gallery/'.$photo->name) }}"
                                alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container zoom-thumbs mt-3 mb-3">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto"
                                src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.$product->thumbnail) }}"
                                alt="">
                        </div>
                        @foreach ($product->photos as $photo)
                        <div class="swiper-slide">
                            <img class="img-responsive m-auto"
                                src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.'gallery/'.$photo->name) }}"
                                alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content">
                    <h2>{{ $product->name }}</h2>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut">
                                @php
                                $price = $product->varibales->sortBY('regular_price')->first();
                                @endphp
                                @if ($price->offer_price == null )
                                {{ $price->regular_price }}
                                @else
                                <small class="text-dark"
                                    style="font-size: 15px"><s>{{ $price->regular_price }}</s></small> <br>
                                {{ $price->offer_price }}
                                @endif

                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                    </div>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="text" value="{{ $product->id }}" name="product_id" hidden>
                        <div class="pro-details-color-info d-flex align-items-center">
                            <span>Color</span>
                            <div class="pro-details-color">
                                <ul>
                                    @php
                                    $grouped = $product->varibales->groupBy('color_id');
                                    @endphp

                                    @foreach ($grouped as $valirable)
                                    <li>
                                        <input type="radio" id="cid{{ $valirable[0]->color_id }}" class="color_id"
                                            value="{{ $valirable[0]->color_id }}" product_id="{{ $product->id }}"
                                            name="color_id">{{ $valirable[0]->color->name }}
                                    </li>
                                    @endforeach
                                    @error('color_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </ul>
                            </div>
                        </div> <!-- Sidebar single item -->
                        <div class="pro-details-size-info d-flex align-items-center">
                            <span>Size</span>
                            <div class="pro-details-size">
                                <ul id="sizehere">

                                </ul>
                                @error('size_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <p class="m-0">{{$product->summery}} </p>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="quantity" value="1" />
                                @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="pro-details-cart">
                                <button type="submit" class="add-cart"> Add To
                                    Cart</button>
                            </div>

                    </form>
                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                        <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                    </div>
                    <div class="pro-details-compare-wishlist pro-details-compare">
                        <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                    </div>
                </div>
                <div class="pro-details-sku-info pro-details-same-style  d-flex">
                    <span>SKU: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="#">{{ $product->slug }}</a>
                        </li>
                    </ul>
                </div>
                <div class="pro-details-categories-info pro-details-same-style d-flex">
                    <span>Categories: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="#">{{ $product->category->name }}.</a>
                        </li>
                        <li>
                            <a href="#">{{ $product->subcategory->name }}</a>
                        </li>
                    </ul>
                </div>
                <div class="pro-details-social-info pro-details-same-style d-flex">
                    <span>Share: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-google"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-bs-toggle="tab" href="#des-details2">Information</a>
                <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper text-start">
                        <ul>
                            <li><span>Weight</span> 400 g</li>
                            <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                            <li><span>Materials</span> 60% cotton, 40% polyester</li>
                            <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>

                            {{ $product->description }}

                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/1.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. Phasellus quam nisi, congue id nulla.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review child-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/2.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                euismod vehicula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <span>Your rating:</span>
                                            <div class="rating-product">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="Your Review" placeholder="Message"></textarea>
                                                    @auth
                                                    <button class="btn btn-primary btn-hover-color-primary "
                                                        type="submit" value="Submit">Submit</button>
                                                    @else
                                                    Join US! To Post a Review.
                                                    <a href="#" class="header-action-btn login-btn"
                                                        data-bs-toggle="modal" data-bs-target="#loginActive">Sign
                                                        In
                                                    </a>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product details description area end -->

<!-- Related product Area Start -->
<div class="related-product-area pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30px0px line-height-1">
                    <h2 class="title m-0">Related Products</h2>

                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
            <div class="new-product-wrapper swiper-wrapper">
                @foreach ($releted as $product)
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="{{ route('front.product.details',[$product->slug,$product]) }}" class="image">
                                <img src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.$product->thumbnail) }}"
                                    alt="{{ $product->name }}" />
                                @foreach ($product->photos as $photo) @if ($loop->index>0) @break @endif
                                <img class="hover-image"
                                    src="{{ asset('thumbnail/'.$product->created_at->format('Y/M/').$product->id.'/'.'gallery/'.$photo->name) }}"
                                    alt="{{ $product->name }}" />
                                @endforeach
                            </a>
                            <span class="badges">
                                <span class="new">New</span>
                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal{{ $product->id }}"><i
                                        class="pe-7s-search"></i></a>
                                <a href="compare.html" class="action compare" title="Compare"><i
                                        class="pe-7s-refresh-2"></i></a>
                            </div>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 100%"></span>
                                </span>
                                <span class="rating-num">( 5 Review )</span>
                            </span>
                            <h5 class="title"><a
                                    href="{{ route('front.product.details',[$product->slug,$product]) }}">{{ $product->name }}
                                    Coat
                                </a>
                            </h5>
                            <span class="price">
                                <span class="new">
                                    @if ($product->varibales->sortby('regular_price')->first()->offer_price == null )
                                    {{ $product->varibales->sortby('regular_price')->first()->regular_price }}
                                    @else
                                    <s class="text-danger" style="font-size: 13px">
                                        {{ $product->varibales->sortby('regular_price')->first()->regular_price}}
                                    </s>
                                    <br>
                                    {{ $product->varibales->sortby('regular_price')->first()->offer_price }}
                                    @endif
                                </span>

                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>
<!-- Related product Area End -->
<!-- Modal -->
@foreach ($releted as $product)


<div class="modal modal-2 fade" id="exampleModal{{ $product->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                        <!-- Swiper -->
                        <div class="swiper-container zoom-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-responsive m-auto"
                                        src="{{ asset('thumbnail').'/'.$product->created_at->format('Y/M/').$product->id.'/'.$product->thumbnail}}"
                                        alt="">

                                </div>

                            </div>
                        </div>
                        <div class="swiper-container zoom-thumbs mt-3 mb-3">
                            <div class="swiper-wrapper">
                                @foreach ($product->photos as $photo)
                                <div class="swiper-slide">
                                    <img class="img-responsive m-auto"
                                        src="{{ asset('thumbnail').'/'.$product->created_at->format('Y/M/').$product->id.'/'.'gallery/'.$photo->name}}"
                                        alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="product-details-content quickview-content">
                            <h2>{{ $product->name }}</h2>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut">
                                        {{ $product->varibales->sortby('regular_price')->first()->regular_price }} tk.
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-rating-wrap">
                                <div class="rating-product">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="read-review"><a class="reviews" href="#">( 5 Customer Review
                                        )</a></span>
                            </div>
                            <p class="mt-30px mb-0">{{ $product->description }}</p>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                </div>
                                <div class="pro-details-cart">
                                    <button class="add-cart"
                                        href="{{ route('front.product.details',[$product->slug,$product]) }}"> Add To
                                        Cart</button>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                    <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-compare">
                                    <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                            </div>
                            <div class="pro-details-sku-info pro-details-same-style  d-flex">
                                <span>SKU: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="#">{{ $product->slug }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-categories-info pro-details-same-style d-flex">
                                <span>Categories: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="#">{{ $product->category->name }}. </a>
                                    </li>
                                    <li>
                                        <a href="#">{{ $product->subcategory->name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-social-info pro-details-same-style d-flex">
                                <span>Share: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-google"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach
<!-- Modal end -->
@endsection
@section('footer_js')
<script>
    jQuery.noConflict();
    $(document).ready(function(){
        $('.color_id').change(function(){
            // alert('pk');
            var color_id = $(this).val();
            var product_id = $(this).attr('product_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: '/get/product/size/',
                data:{color_id:color_id, product_id:product_id,},
                success:(res)=>{
                    if(res){
                        $('#sizehere').html(res);
                    }
                }
            });
        });
    });
</script>
@endsection
