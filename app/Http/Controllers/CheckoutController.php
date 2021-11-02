<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\BillingAmount;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\OrderedProduct;
use App\Models\Profile;
use App\Models\Variable;
use Igaster\LaravelCities\Geo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }

    public function index()
    {
        if (!auth()->id()) {
            return redirect()->route('customer.auth.index');
        }
        if (getcarts()->count() == 0) {
            session()->forget('subtotal');
            session()->forget('discount');
            session()->forget('coupon_name');
            session()->forget('shipping');
            session()->forget('grand_total');
            return redirect('/');
        }
        $profile = Profile::with('user')->where('user_id', auth()->id())->first();
        $cities = Geo::getCountry('bd')->level(Geo::LEVEL_1)->orderBy('population', 'DESC')->get();
        return view('frontend.pages.checkout', compact('profile', 'cities'));
    }

    public function store(CheckoutRequest $request)
    {
        //
        // return $request->all();
        if (getGeoName($request->city) == "Dhaka") {
            session()->put('shipping', 50);
        }
        session()->put('shipping', 120);

        $billing_detail = BillingDetail::create($request->except('_token', 'user_id') + [
            "user_id" => auth()->id(),
        ]);
        $billing_amount = BillingAmount::create([
            "billing_detail_id" => $billing_detail->id,
            "subtotal" => session('subtotal'),
            "discount" => session('discount'),
            "coupon_name" => session('coupon_name'),
            "shipping" => session('shipping'),
            "grand_total" => round(session('grand_total') + session('shipping')),
            "payment_status" => 1,
        ]);
        if (session('coupon_name')) {
            Coupon::where('name', session('coupon_name'))->decrement("limit", 1);
        }
        foreach (Cart::where("cookie_id", Cookie::get('cookie_id'))->get() as $cart) {
            OrderedProduct::create([
                "billing_amount_id" => $billing_amount->id,
                "product_id" => $cart->product_id,
                "color_id" => $cart->color_id,
                "size_id" => $cart->size_id,
                "quantity" => $cart->quantity,
            ]);
            Variable::where([
                "product_id" => $cart->product_id,
                "color_id" => $cart->color_id,
                "size_id" => $cart->size_id,
                "quantity" => $cart->quantity,
            ])->decrement("quantity", $cart->quantity);
            $cart->delete();
        }
        session()->forget('subtotal');
        session()->forget('discount');
        session()->forget('coupon_name');
        session()->forget('shipping');
        session()->forget('grand_total');

        return redirect()->route('checkout.finish');
    }
    public function checkoutFinish()
    {
        return view('frontend.pages.finish');
    }
}
