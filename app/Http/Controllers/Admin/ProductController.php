<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Products/Index', [
            'products' => Product::with('category')->orderBy('order')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Form', [
            'categories' => ProductCategory::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['name']);

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('uploads/products', 'public');
            $data['image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['image_upload']);
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã thêm sản phẩm.');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Form', [
            'product' => $product,
            'categories' => ProductCategory::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validatedData($request);

        if ($product->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $product->id);
        }

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('uploads/products', 'public');
            $data['image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['image_upload']);
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật sản phẩm.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'product_category_id' => 'nullable|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:2048',
            'image_upload' => 'nullable|image|max:5120',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'san-pham';
        $slug = $base;
        $counter = 2;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
