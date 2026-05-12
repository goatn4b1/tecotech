<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Posts/Index', [
            'posts' => Post::with('categoryRelation')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Posts/Form', [
            'categories' => Category::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['category'] = $this->categoryName($data['category_id'] ?? null, $data['category'] ?? null);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('uploads/posts', 'public');
            $data['image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['featured_image']);
        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Da them bai viet.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Form', [
            'post' => $post,
            'categories' => Category::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validatedData($request);

        if ($post->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $post->id);
        }

        $data['category'] = $this->categoryName($data['category_id'] ?? null, $data['category'] ?? null);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('uploads/posts', 'public');
            $data['image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['featured_image']);
        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Da cap nhat bai viet.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Da xoa bai viet.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:2048',
            'featured_image' => 'nullable|image|max:5120',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:2048',
            'canonical_url' => 'nullable|string|max:255',
            'meta_robots' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'bai-viet';
        $slug = $base;
        $counter = 2;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    private function categoryName(?int $categoryId, ?string $fallback): ?string
    {
        if (! $categoryId) {
            return $fallback;
        }

        return Category::find($categoryId)?->name ?: $fallback;
    }
}
