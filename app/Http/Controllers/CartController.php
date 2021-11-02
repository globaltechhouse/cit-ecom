<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Igaster\LaravelCities\Geo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($coupon = null)
    {
        $cities = Geo::getCountry('bd')
            ->level(Geo::LEVEL_1)
            ->orderBy('population', 'DESC')
            ->get();
        $discount = 0;
        $coupon_name = '';
        if ($coupon != null) {
            $coupon = Coupon::where('name', $coupon)->first();
            if ($coupon) {
                if ($coupon->validity >= now()->format('Y-m-d') && $coupon->limit > 0) {

                    $discount = $coupon->amount;
                    $coupon_name  = $coupon->name;
                    return view('frontend.pages.cart', compact('discount', 'coupon_name', 'cities'));
                }
                return redirect('cart/#coupon_section')->with('coupon_error', 'This coupon is Wrong!');
            }
            return redirect('cart/#coupon_section')->with('coupon_error', 'Wrong Coupon!');
        }
        return view('frontend.pages.cart', compact('discount', 'coupon_name', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'product_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($request->hasCookie('cookie_id')) {
            $cookie = $request->cookie('cookie_id');
            if (Cart::where(["cookie_id" => $cookie, "product_id" => $request->product_id, "color_id" => $request->color_id, "size_id" => $request->size_id])->exists()) {

                Cart::where([
                    "cookie_id" => $cookie, "product_id" => $request->product_id,
                    "color_id" => $request->color_id, "size_id" => $request->size_id
                ])->first()->increment('quantity', $request->quantity);
                return back();
            }
            Cart::create($request->except('_token') + ["cookie_id" => $cookie]);
            return back();
        }
        $cookie = Str::random(10) . time();
        Cookie::queue("cookie_id", $cookie, 60);

        Cart::create($request->except('_token') + ["cookie_id" => $cookie]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function updatecart(Request $request, Cart $cart)
    {
        if ($cart->quantity < $request->quantity) {
            $cart->increment('quantity', $request->quantity);
            return back();
        } elseif ($cart->quantity > $request->quantity) {
            $cart->decrement('quantity', $request->quantity);
            return back();
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function delete(Cart $cart)
    {
        $cart->delete();
        return back();
    }
    #           Ajax Method
    public function getDistrictList(Request $request)
    {

        $District_List = Geo::getCountry("BD")->where('parent_id', $request->city_id)->orderBy('name', 'ASC')->get();
        return response()->json($District_List);
    }
    public function getTownList(Request $request)
    {
        if (Geo::findorfail($request->district_id)->name == 'Dhaka') {
            session()->put('shipping', 50);
        } else {
            session()->put('shipping', 120);
        }
        $town_List = Geo::getCountry("BD")->where('parent_id', $request->district_id)->orderBy('name', 'ASC')->get();
        return response()->json($town_List);
    }
}
