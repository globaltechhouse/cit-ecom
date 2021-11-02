@extends('frontend.master')
@section('content')


<!-- breadcrumb-area start -->


<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="table-content table-responsive cart-table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @forelse (getcarts() as $cart)
                            <tr>
                                <td class="product-thumbnail">
                                    <a
                                        href="{{ route('front.product.details',[$cart->product->slug,$cart->product]) }}"><img
                                            class="img-responsive ml-15px"
                                            src="{{ asset('thumbnail/'.$cart->product->created_at->format('Y/M/').$cart->product->id.'/'.$cart->product->thumbnail) }}"
                                            alt="" /></a>
                                </td>
                                <td class="product-name"><a
                                        href="{{ route('front.product.details',[$cart->product->slug,$cart->product]) }}">{{ $cart->product->name }}</a>
                                </td>
                                <td class="product-price-cart">
                                    <span class="amount">
                                        @php
                                        $price= price($cart->product_id,$cart->color_id,$cart->size_id)->offer_price ??
                                        price($cart->product_id,$cart->color_id,$cart->size_id)->regular_price;
                                        @endphp
                                        {{ $price }}
                                    </span>
                                    <span> Tk.</span>
                                </td>
                                <form action="{{ route('cart.updatecart',$cart) }}">
                                    @csrf
                                    <td class="product-quantity">

                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="quantity"
                                                value="{{ $cart->quantity }}" />
                                        </div>

                                    </td>

                                    <td class="product-subtotal">{{ $price * $cart->quantity }}<span> Tk.</span></td>
                                    @php $total += $price * $cart->quantity; @endphp
                                    <td class="product-remove">
                                        <button type="submit"><i class="fa fa-pencil"></i></button>
                                        <a href="{{ route('cart.delete',$cart) }}"><i class="fa fa-times"></i></a>
                                    </td>
                                </form>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="50">N/A</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-shiping-update-wrapper">
                            <div class="cart-shiping-update">
                                <a href="#">Continue Shopping</a>
                            </div>
                            <div class="cart-clear">
                                <button>Update Shopping Cart</button>
                                <a href="#">Clear Shopping Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @if (getcarts()->count()>0)
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * City
                                        </label>
                                        <select id="city_dropdown" class="email s-email s-wid">
                                            <option value="">Select</option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * District
                                        </label>
                                        <select id="district_dropdown" class="email s-email s-wid">

                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Town
                                        </label>
                                        <select id="town_dropdown" class="email s-email s-wid">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-lm-30px" id="coupon_section">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <input id="coupon_name" type="text" required="" name="name" @if($coupon_name)
                                    value="{{ $coupon_name }}" @endif /> <br>
                                @if($coupon_name)
                                <div class="text-success">
                                    <span class="text-success h4">Coupon applied!</span>
                                </div>
                                @else
                                <div class="text-danger">
                                    <span class="text-danger h4">{{ session('coupon_error')  }}</span>
                                </div>
                                @endif
                                <button class="cart-btn-2" id="coupon_btn">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Sub-Total <span>{{ $total }}</span> </h5>
                            <h5>Discount @if($coupon_name) ( {{ $coupon_name }} ) @endif
                                <span>{{ $discount }} %</span>
                            </h5>
                            <h5>Discounted Amount <span>{{ round(discounted($total ,$discount)) }}</span> </h5>
                            <h5>Shipping <span id="shipping_cost"> {{ session('shipping') }} </span>
                            </h5>

                            <h4 class="grand-totall-title">Grand Total
                                <span
                                    id="grand_total">{{ round(discounted($total ,$discount) + session('shipping'))  }}</span>
                            </h4>
                            @php
                            session()->put('subtotal',$total);
                            session()->put('coupon_name', $coupon_name);
                            session()->put('discount',$discount);
                            session()->put('grand_total',round(discounted($total ,$discount)));
                            @endphp


                            <a id="proceed" href="{{ route('checkout.index') }}">Proceed to Checkout</a>


                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->

@endsection

@section('footer_js')
<script>
    $(document).ready(function(){
        $('#coupon_btn').click(function(){
            var coupon = $("#coupon_name").val();
            var address = "{{ route('cart.index') }}/" + coupon;
            window.location.href = address;
        });

         $("#city_dropdown").change(function(){
            var grand_total = parseInt($("#grand_total").text());
                var city_id = $('#city_dropdown').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url:'{{ route('cart.DistrictList') }}',
                    data: {city_id: city_id},
                    success: function(res){
                        $("#district_dropdown").empty();
                        $("#district_dropdown").append('<option value="">--Select One--</option>');
                        let options = "";
                        $.each(res,function (key,value) {
                            options += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        $("#district_dropdown").append(options);
                    }
                });
                $("#district_dropdown").change(function(){

                    var district_id = $("#district_dropdown").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/get/town/list',
                        data: {district_id: district_id},
                        success:function(res){
                            $("#town_dropdown").empty();
                            $("#town_dropdown").append('<option value="">--Select One--</option>');
                            let options = "";
                            $.each(res,function (key,value) {
                            options += '<option value="'+value.id+'">'+value.name+'</option>';
                            });
                            $("#town_dropdown").append(options);
                        }


                    });

                        if (grand_total) {
                            if($('#district_dropdown :selected').text() == 'Dhaka'){
                                $('#shipping_cost').html(50);
                                $("#grand_total").text({{ session("grand_total") }}+50);
                            }
                            else{

                                $('#shipping_cost').html(120);
                                $("#grand_total").text({{ session("grand_total") }}+120);
                            }
                        }
                });
        });



    });
</script>


@endsection
