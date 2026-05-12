<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Đã thêm danh mục!');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Form', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        if ($category->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name']);
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Đã cập nhật danh mục!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Đã xóa danh mục!');
    }
}
