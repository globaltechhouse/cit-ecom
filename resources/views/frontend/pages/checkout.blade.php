@extends('frontend.master')
@section('content')

<!-- checkout area start -->
<div class="checkout-area pt-100px pb-100px">
    <form id="checkout_form" action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="container">
            <h1 class="text-center display-4"><b>Checkout</b></h1><br>
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Billing Details</h3>
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $profile->user->name }}" required />
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Mobile No.</label>
                                    <input type="tel" name="mobile_no" value="{{ $profile->mobile_no }}" required />
                                </div>
                                @error('mobile_no')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Email Address</label>
                                    <input type="email" name="email" value="{{ $profile->user->email }}" required />
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-select mb-4">
                                    <label>City</label>
                                    <select id="city_dropdown" name="city" required class="email s-email s-wid">
                                        <option value="">Select</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('city_dropdown')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-select mb-4">
                                    <label>District</label>
                                    <select id="district_dropdown" required name="district" class="email s-email s-wid">
                                        <option value="">Select</option>
                                    </select>
                                    @error('district_dropdown')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-select mb-4">
                                    <label>Thana / Upozela</label>
                                    <select id="town_dropdown" name="thana" class="email s-email s-wid">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                @error('town_dropdown')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Postcode / ZIP</label>
                                    <input type="text" name="zipcode" />
                                </div>
                                @error('zipcode')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Street Address</label>
                                    <input class="billing-address" name="address"
                                        placeholder="House number and street name" type="text" required />
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="additional-info-wrap">
                            <h4>Additional information</h4>
                            <div class="additional-info">
                                <label>Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                    name="order_note"></textarea>
                            </div>
                            @error('order_note')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Product</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        @foreach (getcarts() as $cart)

                                        <li><span class="order-middle-left">
                                                <a
                                                    href="{{ route('front.product.details',[$cart->product->slug,$cart->product]) }}">
                                                    {{ $cart->product->name }}
                                                </a>{{ ' X '. $cart->quantity }}
                                            </span>
                                            <span class="order-price">
                                                @php
                                                $price=(price($cart->product_id,$cart->color_id,$cart->size_id)->offer_price)
                                                ??
                                                (price($cart->product_id,$cart->color_id,$cart->size_id)->regular_price);
                                                @endphp
                                                {{ $price * $cart->quantity }} tk.
                                            </span>
                                        </li>
                                        <hr>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Discount
                                            {{ session('coupon_name') ? '('.session('coupon_name').')' : '' }}
                                        </li>
                                        <li>{{ session('discount') }}%</li>
                                    </ul>
                                    <hr>
                                    <ul>
                                        <li class="your-order-shipping">Discounteed</li>
                                        <li id="discounted">
                                            {{ round(discounted(session('subtotal') ,session('discount'))) }}
                                        </li>
                                    </ul>
                                    <hr>
                                    <ul>
                                        <li class="your-order-shipping">Shipping</li>
                                        <li id="shipping_cost">Free</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li id="grand_total">{{ session('grand_total') }}
                                            <span>Tk.</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div id="faq" class="panel-group">
                                        <hr>
                                        <div class="panel panel-default single-my-account m-0">
                                            <h2 class="text-success">** Payment Method **</h2><br>
                                            <div class="input-radio">
                                                <h4>
                                                    <span class="custom-radio">
                                                        <input id="sslcommerz" type="radio" value="sslcommerz"
                                                            name="payment_method" required>
                                                        <label for="sslcommerz"> SSLCommerz Payment
                                                            <img src="https://www.sslcommerz.com/wp-content/uploads/2020/03/favicon.png"
                                                                alt="" class="ml-3" width="22">
                                                        </label>
                                                    </span>
                                                </h4>
                                                <h4>
                                                    <span class="custom-radio">
                                                        <input id="cash_on_delivery" type="radio"
                                                            value="cash_on_delivary" name="payment_method" required>
                                                        <label for="cash_on_delivery"> Cash on Delivery
                                                            <img src="//cdn-icons-png.flaticon.com/512/1554/1554401.png"
                                                                alt="" class="ml-3" width="30">
                                                        </label>
                                                    </span>
                                                </h4>
                                            </div> <br>
                                        </div>
                                        @error('payment_method')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <button class="btn btn-primary" type="submit">Place Order </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<!-- checkout area end -->

@endsection

@section('footer_js')
<script>
    $(document).ready(function(){
        $('#coupon_btn').click(function(){
            var coupon = $("#coupon_name").val();
            var address = "{{ route('cart.index') }}/" + coupon;
            window.location.href = address;
        });
        var grand_total = parseInt($("#grand_total").text());
         $("#city_dropdown").change(function(){
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

            $("#sslcommerz").change(function(){
                $("#checkout_form").attr("action","{{ url('/pay') }}");
            });
            $("#cash_on_delivery").change(function(){
                $("#checkout_form").attr("action","{{ route('checkout.store') }}");
            });




    });
</script>

@endsection
