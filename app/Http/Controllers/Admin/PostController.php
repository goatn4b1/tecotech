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
        $data = $this->withSeoFallbacks($data);
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
        $data = $this->withSeoFallbacks($data, $post);
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

    private function withSeoFallbacks(array $data, ?Post $post = null): array
    {
        $slug = $data['slug'] ?? $post?->slug ?? Str::slug($data['title'] ?? 'bai-viet');
        $image = $data['image'] ?? $post?->image ?? null;
        $plainContent = trim(preg_replace('/\s+/', ' ', strip_tags($data['content'] ?? $post?->content ?? '')));
        $description = trim($data['excerpt'] ?? '') ?: $plainContent;

        $data['meta_title'] = trim($data['meta_title'] ?? '') ?: Str::limit(($data['title'] ?? $post?->title ?? '') . ' - TECOTECH', 60, '');
        $data['meta_description'] = trim($data['meta_description'] ?? '') ?: Str::limit($description, 160, '');
        $data['meta_keywords'] = trim($data['meta_keywords'] ?? '') ?: $this->keywordsFromTitle($data['title'] ?? $post?->title ?? '');
        $data['og_image'] = trim($data['og_image'] ?? '') ?: $image;
        $data['canonical_url'] = trim($data['canonical_url'] ?? '') ?: route('posts.show', $slug);
        $data['meta_robots'] = trim($data['meta_robots'] ?? '') ?: 'index, follow';

        return $data;
    }

    private function keywordsFromTitle(string $title): string
    {
        $words = collect(preg_split('/\s+/', Str::lower(Str::ascii($title))))
            ->map(fn ($word) => trim($word, " \t\n\r\0\x0B,.;:!?()[]{}\"'"))
            ->filter(fn ($word) => Str::length($word) >= 3)
            ->unique()
            ->take(8)
            ->values()
            ->all();

        return implode(', ', array_filter([
            implode(', ', $words),
            'tecotech',
        ]));
    }
}
