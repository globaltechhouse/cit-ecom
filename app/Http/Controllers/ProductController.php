<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Variable;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'administrator']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBY('created_at', 'desc')->paginate(5);
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('backend.product.create', compact('categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // return $request->all();
        $request->validate([
            "slug" => "required|unique:products",
        ]);

        $product = Product::create([
            "name" => $request->name,
            "slug" => $request->slug,
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "summery" => $request->summery,
            "description" => $request->description,
            "thumbnail" => "default.png",
        ]);

        // Product Thumbnail
        $save_location = public_path('thumbnail/') . $product->created_at->format('Y/M/') . $product->id . '/';
        File::makeDirectory($save_location, 0777, true, true);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $image_name = $product->name . Str::random() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800)->save($save_location . $image_name);
            $product->thumbnail = $image_name;
            $product->slug = $request->slug . '-' . Str::random(4) . '-' . $product->id;
        }
        $product->save();

        // Product Variables
        foreach ($request->color_id as $key => $value) {
            if ($value == null) {
                break;
            } else {
                Variable::create([
                    'product_id' => $product->id,
                    'color_id' => $value,
                    'size_id' => $request->size_id[$key],
                    'quantity' => $request->quantity[$key],
                    'regular_price' => $request->regular_price[$key],
                    'offer_price' => $request->offer_price[$key],
                ]);
            }
        }

        // Gallery Images
        if ($request->hasFile("gallery")) {
            $gallery_location = public_path('thumbnail/') . $product->created_at->format('Y/M/') . $product->id . "/" . "gallery/";
            File::makeDirectory($gallery_location, 0777, true, true);

            foreach ($request->file("gallery") as $key => $image) {
                $extention = $image->getClientOriginalExtension(); // Extenion
                if ($extention == "jpg" || $extention == "jpeg" || $extention == "png") { //getting Extention Checked
                    $image_name = 'image-' . $key . Str::random(4) . '.' . $extention;
                    Gallery::create([
                        "product_id" => $product->id,
                        "name" => $image_name,
                    ]);
                    Image::make($image)->resize(800, 800)->save($gallery_location . $image_name);
                } else {
                    session()->put('gallery_error', "Please! Select image only.");
                }
            }
        }

        return back()->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::with('products')->get();
        $subcategories = Subcategory::with('products')->where('category_id', $product->category_id)->orderBY('name')->get();
        $colors = Color::all();
        $sizes = Size::all();
        return view('backend.product.edit', compact('product', 'categories', 'colors', 'sizes', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // return $request->all();
        $request->validate([
            "slug" => "required|unique:products,slug," . $product->id,
            "color_id" => "required|array|min:1",
            "size_id" => "required|array|min:1",
            "quantity" => "required|array|min:1",
            "regular_price" => "required|array|min:1",
            "offer_price" => "required|array|min:1",
        ]);

        $product->update([
            "name" => $request->name,
            "slug" => $request->slug,
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "summery" => $request->summery,
            "description" => $request->description,
        ]);

        $old_image = public_path('thumbnail/') . $product->created_at->format('Y/M/') . $product->id . '/' . $product->thumbnail;
        $save_location = public_path('thumbnail/') . $product->created_at->format('Y/M/') . $product->id . '/';

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $image_name = $product->name . Str::random() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800)->save($save_location . $image_name);
            $product->thumbnail = $image_name;
            $product->slug = $request->slug . '-' . Str::random(4) . '-' . $product->id;
            $product->save();
        }
        if ($request->hasFile("gallery")) {
            $gallery_location = public_path('thumbnail/') . $product->created_at->format('Y/M/') . $product->id . "/" . "gallery/";
            File::makeDirectory($gallery_location, 0777, true, true);

            foreach ($request->file("gallery") as $key => $image) {
                $extention = $image->getClientOriginalExtension(); // Extenion
                if ($extention == "jpg" || $extention == "jpeg" || $extention == "png") { //getting Extention Checked
                    $image_name = 'image-' . $key . Str::random(4) . '.' . $extention;
                    Gallery::create([
                        "product_id" => $product->id,
                        "name" => $image_name,
                    ]);
                    Image::make($image)->resize(800, 800)->save($gallery_location . $image_name);
                } else {
                    session()->put('gallery_error', "Please! Select image only.");
                }
            }
        }
        foreach ($request->color_id as $key => $value) {
            if ($value != null) {
                if (isset($request->id[$key])) {
                    $varibale = Variable::findOrFail($request->id[$key]);
                    $varibale->color_id = $value;
                    $varibale->size_id = $request->size_id[$key];
                    $varibale->quantity = $request->quantity[$key];
                    $varibale->regular_price = $request->regular_price[$key];
                    $varibale->offer_price = $request->offer_price[$key];
                    $varibale->save();
                } else {
                    Variable::create([
                        "product_id" => $product->id,
                        "color_id" => $value,
                        "size_id" => $request->size_id[$key],
                        "quantity" => $request->quantity[$key],
                        "regular_price" => $request->regular_price[$key],
                        "offer_price" => $request->offer_price[$key],
                    ]);
                }
            } else {
                return back()->with('success', 'Updated Succesfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->varibales->count() < 1) {
            foreach ($product->varibales as $variable) {
                Variable::findorFail($variable->id)->delete();
            }
            $product->delete();
            return back()->with('success', 'Deletation Successful.');
        }
        return back()->with('error', 'Can not delete that Product');
    }

    public function destroygallery(Product $product, Gallery $gallery)
    {
        // return $gallery . $product;
        $old_image = public_path('thumbnail/') . $product->created_at->format("Y/M") . $product->id . "/" . "gallery/" . $gallery->name;
        if (file_exists($old_image)) {
            unlink($old_image);
            $gallery->delete();
            return back();
        }
        $gallery->delete();
        return back();
    }

    //          Ajax Method Here
    public function ajaxGetSubcategory(Request $request)
    {
        $subcategory = Subcategory::where('category_id', $request->category_id)->orderBY("name")->get();
        return response()->json($subcategory);
    }
}
