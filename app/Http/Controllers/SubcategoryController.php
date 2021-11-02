<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
        $subcategories = Subcategory::orderBY('created_at', 'DESC')->paginate(10);
        return view('backend.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:subcategories",
            "slug" => "required|unique:subcategories",
            "category_id" => "required",
        ]);

        Subcategory::create($request->except('_token'));
        return back()->with('success', 'Subcategory has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        return view('backend.subcategory.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            "name" => "required|unique:subcategories,name," . $subcategory->id,
            "slug" => "required|unique:subcategories,slug," . $subcategory->id,
            "category_id" => "required",
        ]);
        $subcategory = Subcategory::updateOrCreate($request->except('_token', '_method'));
        return back()->with('success', 'Subcategory Edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->Category->count() < 1) {
            $subcategory->delete();
            return back()->with('success', 'Subcategory deleted.');
        }
        return back()->with('error', 'Subcategory deleted.');
    }


    public function trash()
    {
        $subcategories = Subcategory::onlyTrashed()->paginate(10);
        return view('backend.subcategory.trash', compact('subcategories'));
    }

    public function restore($id)
    {
        Subcategory::onlyTrashed()->findorfail($id)->restore($id);
        return back()->with('success', ' subcategory Restored');
    }
}
