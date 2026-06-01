<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ProductCategories/Index', [
            'categories' => ProductCategory::withCount('products')->orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ProductCategories/Form');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['name']);

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('uploads/product-categories', 'public');
            $data['image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['image_upload']);
        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Đã thêm danh mục sản phẩm.');
    }

    public function edit(ProductCategory $productCategory)
    {
        return Inertia::render('Admin/ProductCategories/Form', [
            'category' => $productCategory,
        ]);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $data = $this->validatedData($request);

        if ($productCategory->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $productCategory->id);
        }

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('uploads/product-categories', 'public');
            $data['image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['image_upload']);
        $productCategory->update($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Đã cập nhật danh mục sản phẩm.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Đã xóa danh mục sản phẩm.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:2048',
            'image_upload' => 'nullable|image|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'danh-muc-san-pham';
        $slug = $base;
        $counter = 2;

        while (
            ProductCategory::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
