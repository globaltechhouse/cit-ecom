@extends('frontend.master')

@section('content')
<style>
    .bgImage {
        background-image: url("{{ asset('front/images/bg/shopping.jpg' )}}");
        height: 100%;
    }
</style>
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                <!-- breadcrumb-list end -->
                <div class="checkout-area ptb-100 bgImage">
                    <div class="container">
                        <h1 class="text-center">Your Order is ready for shipping.</h1>
                        <div class="card-body">
                            <h1 class="text-center">
                                <a href="{{ route('front.index') }}"><img
                                        src="https://i.pinimg.com/originals/df/03/fc/df03fc5c32b309a299bc95260089b0cd.gif"
                                        width="80%" alt=""></a>
                            </h1>
                        </div>
                        <div class="card-footer">
                            <h3 class="text-center">Happy Shopping! ☺</h3>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- breadcrumb-area end -->


@endsection
