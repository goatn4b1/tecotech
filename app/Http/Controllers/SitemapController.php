<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Response;
use Inertia\Inertia;

class SitemapController extends Controller
{
    public function index()
    {
        $pages = Page::where('is_active', true)->get();
        $posts = Post::where('is_active', true)->get();

        return Inertia::render('Sitemap', [
            'pages' => $pages,
            'posts' => $posts,
            'staticLinks' => [
                ['url' => '/', 'label' => 'Trang chủ'],
                ['url' => '/gioi-thieu', 'label' => 'Giới thiệu'],
                ['url' => '/moi-truong', 'label' => 'Môi trường'],
                ['url' => '/gia-cong-co-khi', 'label' => 'Gia công cơ khí'],
                ['url' => '/cong-trinh', 'label' => 'Công trình'],
                ['url' => '/tin-tuc', 'label' => 'Tin tức'],
                ['url' => '/lien-he', 'label' => 'Liên hệ'],
            ]
        ]);
    }

    public function xml(): Response
    {
        $pages = Page::where('is_active', true)->get();
        $posts = Post::where('is_active', true)->get();
        $baseUrl = url('/');

        $xml = view('sitemap', [
            'pages' => $pages,
            'posts' => $posts,
            'baseUrl' => $baseUrl,
        ])->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
