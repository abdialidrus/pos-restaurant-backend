<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //index
    public function index(Request $request)
    {
        $products = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.name as category_name', 'products.*')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('products.name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);


        return view('pages.product.index', compact('products'));
    }

    //create
    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'is_available' => 'required',
            'image' => 'required',
        ]);

        $category = Category::findOrFail($request->category_id);
        $product = new Product;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->is_available = $request->boolean('is_available');

        $category->products()->save($product);


        $image = $request->file('image');
        $image->storeAs('public/images/product', $product->id . '.' . $image->getClientOriginalExtension());

        $product->image_url = 'storage/images/product/' . $product->id . '.' . $image->getClientOriginalExtension();
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    //show
    public function show($id)
    {
        $product = Product::find($id);
        return view('pages.product.show', compact('product'));
    }

    //edit
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'is_available' => 'required',
        ]);

        $category = Category::findOrFail($request->category_id);
        $product = Product::find($id);;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->is_available = $request->boolean('is_available');

        $category->products()->save($product);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/images/product', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image_url = 'storage/images/product/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
