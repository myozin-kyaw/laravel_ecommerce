<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $request->status == TRUE ? '1' : '0';
        $data['popular'] = $request->popular == TRUE ? '1' : '0';
        if ($request->hasFile('image')) {
            $imageName = date('YmdHis') . " . " . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/category'), $imageName);
            $data['image'] = $imageName;
        }
        Category::create($data);
        return redirect()->route('categories.index')->with('status','New Category Successfully added');
    }

    public function edit($id) 
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    { 
        $data = $request->validated();
        $data['status'] = $request->status == TRUE ? '1' : '0';
        $data['popular'] = $request->popular == TRUE ? '1' : '0';

        if ($request->hasFile('image')) {
            $path = 'images/category/'.$category->image;
            if (file_exists($path)) {
                File::delete($path);
            }
            $imageName = date('YmdHis') . " . " . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/category'), $imageName);
            $data['image'] = $imageName;
        }
        $category->update($data);
        return redirect()->route('categories.index')->with('status','Category Successfully updated');
    }

    public function destroy(Category $category) 
    {
        if ($category->image) {
            $path = 'images/category/'.$category->image;
            if (file_exists($path)) {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect()->route('categories.index')->with('status','Category Successfully deleted');
    }
}
