<?php

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Variable;
use Igaster\LaravelCities\Geo;
use Illuminate\Support\Facades\Cookie;


function getcarts()
{
    return Cart::where("cookie_id", Cookie::get('cookie_id'))->get();
}

function price($p_id, $c_id, $s_id)
{
    return Variable::where(['product_id' => $p_id, 'color_id' => $c_id, 'size_id' => $s_id])->first();
}

function discounted($total, $discount)
{
    return $total - ($total * ($discount / 100));
}
function coupon()
{
    return Coupon::orderby('created_at', 'desc')->first();
}
function getGeoName($id)
{
    return Geo::findorFail($id)->name;
}
