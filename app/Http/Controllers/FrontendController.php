<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Variable;
use Igaster\LaravelCities\Geo;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {

        $categories = Category::with('products')->withCount('products')->limit(5)->get();
        $products = Product::orderBy('created_at')->get();
        $coupon = Coupon::where('validity', '>=', now()->format('Y-m-d'))->where('limit', '>', 0)->orderBy('created_at', 'desc')->first();
        return view('frontend.pages.index', compact('categories', 'products', 'coupon'));
    }

    public function signleProduct($slug, Product $product)
    {
        $releted = Product::where('id', '!=', $product->id)->take(10)->get();
        return view('frontend.pages.product_details', compact('product', 'releted'));
    }
    public function getProductSize(Request $request)
    {
        $sizes = Variable::with('size')->where(['product_id' => $request->product_id, "color_id" => $request->color_id])->get();
        $list = '';
        foreach ($sizes as $size) {
            $list = $list . '<li><input type="radio" name="size_id" id="size' . $size->size_id . '" color_id="' . $size->color_id . '" product_id="' . $size->product_id . '" value="' . $size->size_id . '">Size: ' . $size->size->name . '</li>';
        }
        return response()->json($list);
    }
}
