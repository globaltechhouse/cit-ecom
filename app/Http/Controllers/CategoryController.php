<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Facade\FlareClient\View;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::orderBY('created_at', 'DESC')->paginate(10);
        return View('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);
        // return $request;
        Category::create($request->except('_token'));
        return back()->with('success', 'category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('backend.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => "required",
            "slug" => "required|unique:categories,slug," . $category->id,
        ]);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return back()->with('success', 'Category edited successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->getSubcategory->count() < 1) {
            $category->delete();
            return back()->with('success', 'category deleted.');
        }
        return back()->with('error', 'Can not delete Category.');
    }


    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(10);
        return view('backend.category.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findorfail($id)->restore($id);
        return back()->with('success', ' category Restored');
    }
}
