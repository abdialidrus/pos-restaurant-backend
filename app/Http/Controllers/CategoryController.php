<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //index
    public function index(Request $request)
    {
        $categories = DB::table('categories')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.category.index', compact('categories'));
    }

    //create
    public function create()
    {
        return view('pages.category.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    //show
    public function show($id)
    {
        $category = Category::find($id);
        return view('pages.category.show', compact('category'));
    }

    //edit
    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.category.edit', compact('category'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
