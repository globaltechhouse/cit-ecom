<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ColorSizeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'administrator']);
    }
    public function colorIndex()
    {
        $colors = Color::orderBY('created_at')->paginate(3);
        return view('backend.color_size.color', compact('colors'));
    }
    public function colorStore(Request $request)
    {

        $request->validate([
            "name" => "required|unique:colors"
        ]);
        Color::create($request->except('_token'));
        return redirect("color/#color_form")->with('success', 'Color Added!');
    }

    public function sizeIndex()
    {
        $sizes = Size::orderBY('created_at')->paginate(3);
        return view('backend.color_size.size', compact('sizes'));
    }

    public function sizeStore(Request $request)
    {
        $request->validate([
            "name" => "required|unique:sizes"
        ]);
        Size::create($request->except('_token'));
        return redirect("size/#size_form")->with('success', 'Size Added!');
    }
}
