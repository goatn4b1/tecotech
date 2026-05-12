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
        ]);
    }
}
