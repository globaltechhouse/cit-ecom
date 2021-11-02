@extends('frontend.master')
@section('content')


<!-- breadcrumb-area start -->


<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your Shooping Item items</h3>
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
                            @forelse ($bill->amount->products as $cart)
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

            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->

@endsection
