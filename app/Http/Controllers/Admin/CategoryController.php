<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $categories = Category::all();
    return view('admin.categories.index', compact('categories'));
}
    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $categories = Category::all();
    return view('admin.categories.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'slug'  => 'required|string|max:255|unique:categories,slug',
    ]);

    // Create the category
    Category::create([
        'parent_id'   => $request->parent_id ?: null,
        'title'       => $request->title,
        'slug'        => $request->slug,
        'description' => $request->description,
        'status'      => $request->status,
    ]);

    // Redirect with success message
    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Category $category)
{
    $categories = Category::all();
    return view('admin.categories.edit', compact('category', 'categories'));
}

public function update(Request $request, Category $category)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'slug'  => 'required|string|max:255|unique:categories,slug,' . $category->id,
    ]);

    $category->update([
        'parent_id'   => $request->parent_id ?: null,
        'title'       => $request->title,
        'slug'        => $request->slug,
        'description' => $request->description,
        'status'      => $request->status,
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category updated successfully!');
}
    /**
     * Remove the specified resource from storage.
     */
 public function destroy(Category $category)
{
    $category->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category deleted successfully!');
}

}
