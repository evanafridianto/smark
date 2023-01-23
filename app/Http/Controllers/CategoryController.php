<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'title' => 'Business Category',
            'categories' => Category::latest()->filter(request('search'))->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('category.create', [
            'title' => 'Add Business Category',
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return back()->with('status', 'category-created');
    }

    public function edit($id)
    {
        return view('category.edit', [
            'title' => 'Edit Business Category',
            'category' => Category::find($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return back()->with('status', 'category-updated');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // return response()->json(['status' => true]);
        // return back();
        return back()->with('status', 'category-deleted');
    }
}