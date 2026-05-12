<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Inertia\Inertia;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return Inertia::render('Page', [
            'pageItem' => $page,
        ])->withViewData([
            'seo_title' => $page->meta_title ?: $page->title . ' - TECOTECH',
            'seo_description' => $page->meta_description,
            'seo_keywords' => $page->meta_keywords,
            'seo_image' => $page->image,
            'seo_canonical' => $page->canonical_url ?: url()->current(),
            'seo_robots' => $page->meta_robots ?: 'index, follow',
        ]);
    }

    public function post(string $slug)
    {
        $post = Post::with('categoryRelation')->where('slug', $slug)->where('is_active', true)->firstOrFail();

        return Inertia::render('PostShow', [
            'post' => $post,
            'relatedPosts' => Post::where('is_active', true)
                ->where('id', '!=', $post->id)
                ->latest()
                ->limit(3)
                ->get(),
        ])->withViewData([
            'seo_title' => $post->meta_title ?: $post->title . ' - TECOTECH',
            'seo_description' => $post->meta_description ?: $post->excerpt,
            'seo_keywords' => $post->meta_keywords,
            'seo_image' => $post->og_image ?: $post->image,
            'seo_canonical' => $post->canonical_url ?: url()->current(),
            'seo_robots' => $post->meta_robots ?: 'index, follow',
        ]);
    }
}
