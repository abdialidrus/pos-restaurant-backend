<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product_categories = DB::table('product_categories')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.product_categories.index', compact('product_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $product_category = new ProductCategory();
        $product_category->name = $request->name;
        $product_category->save();

        return redirect()->route('product_categories.index')->with('success', 'Product category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product_category = ProductCategory::find($id);
        return view('pages.product_categories.show', compact('product_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product_category = ProductCategory::find($id);
        return view('pages.product_categories.edit', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $product_category = ProductCategory::find($id);
        $product_category->name = $request->name;
        $product_category->save();

        return redirect()->route('product_categories.index')->with('success', 'Product category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $product_category)
    {
        $product_category = ProductCategory::find($product_category->id);
        $product_category->delete();

        return redirect()->route('product_categories.index')->with('success', 'Product category deleted successfully.');
    }
}
