<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Pages/Index', [
            'pages' => Page::orderBy('title')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Pages/Form');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);

        if ($request->hasFile('hero_upload')) {
            $path = $request->file('hero_upload')->store('uploads/pages', 'public');
            $data['hero_image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['hero_upload']);

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Da them trang.');
    }

    public function edit(Page $page)
    {
        return Inertia::render('Admin/Pages/Form', [
            'pageItem' => $page,
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $data = $this->validatedData($request);
        $slugSource = $data['slug'] ?: $data['title'];
        $data['slug'] = $this->uniqueSlug($slugSource, $page->id);

        if ($request->hasFile('hero_upload')) {
            $path = $request->file('hero_upload')->store('uploads/pages', 'public');
            $data['hero_image'] = $request->getSchemeAndHttpHost().'/storage/'.$path;
        }

        unset($data['hero_upload']);

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Da cap nhat trang.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Da xoa trang.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'hero_image' => 'nullable|string|max:2048',
            'hero_upload' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:2048',
            'canonical_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'trang';
        $slug = $base;
        $counter = 2;

        while (
            Page::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
