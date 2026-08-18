<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Support\Str;
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
        $settings = Setting::all()->pluck('value', 'key');
        $canonical = $post->canonical_url ?: route('posts.show', $post->slug);
        $description = $post->meta_description ?: $this->excerpt($post->excerpt ?: $post->content);
        $image = $this->absoluteUrl($post->og_image ?: $post->image ?: ($settings['home_og_image'] ?? null));
        $siteName = $settings['site_name'] ?? 'TECOTECH';
        $logo = $this->absoluteUrl($settings['site_logo'] ?? $settings['home_og_image'] ?? null);
        $schema = $this->articleSchema($post, $siteName, $canonical, $description, $image, $logo);

        return Inertia::render('PostShow', [
            'post' => $post,
            'relatedPosts' => Post::where('is_active', true)
                ->where('id', '!=', $post->id)
                ->latest()
                ->limit(3)
                ->get(),
            'articleSchema' => $schema,
        ])->withViewData([
            'seo_title' => $post->meta_title ?: $post->title . ' - TECOTECH',
            'seo_description' => $description,
            'seo_keywords' => $post->meta_keywords,
            'seo_image' => $image,
            'seo_canonical' => $canonical,
            'seo_robots' => $post->meta_robots ?: 'index, follow',
            'seo_type' => 'article',
            'seo_site_name' => $siteName,
            'seo_published_time' => $post->created_at?->toAtomString(),
            'seo_modified_time' => $post->updated_at?->toAtomString(),
            'seo_section' => $post->categoryRelation?->name ?: $post->category,
            'seo_schema' => $schema,
        ]);
    }

    public function product(string $slug)
    {
        $product = \App\Models\Product::with('category')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        return Inertia::render('ProductShow', [
            'product' => $product,
            'relatedProducts' => \App\Models\Product::with('category')
                ->where('is_active', true)
                ->where('id', '!=', $product->id)
                ->latest()
                ->limit(3)
                ->get(),
        ])->withViewData([
            'seo_title' => $product->name . ' - TECOTECH',
            'seo_description' => $product->excerpt ?: $this->excerpt($product->content),
            'seo_image' => $this->absoluteUrl($product->image),
            'seo_canonical' => url()->current(),
            'seo_robots' => 'index, follow',
        ]);
    }

    private function excerpt(?string $value, int $limit = 160): string
    {
        return Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($value ?? ''))), $limit, '');
    }

    private function absoluteUrl(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        return Str::startsWith($value, '/')
            ? url($value)
            : asset($value);
    }

    private function articleSchema(Post $post, string $siteName, string $canonical, string $description, ?string $image, ?string $logo): array
    {
        $publisher = [
            '@type' => 'Organization',
            'name' => $siteName,
            'url' => url('/'),
        ];

        if ($logo) {
            $publisher['logo'] = [
                '@type' => 'ImageObject',
                'url' => $logo,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Article',
                    'mainEntityOfPage' => [
                        '@type' => 'WebPage',
                        '@id' => $canonical,
                    ],
                    'headline' => $post->title,
                    'description' => $description,
                    'image' => $image ? [$image] : [],
                    'datePublished' => $post->created_at?->toAtomString(),
                    'dateModified' => $post->updated_at?->toAtomString(),
                    'author' => [
                        '@type' => 'Organization',
                        'name' => $siteName,
                    ],
                    'publisher' => $publisher,
                    'articleSection' => $post->categoryRelation?->name ?: $post->category,
                    'keywords' => $post->meta_keywords,
                ],
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'name' => 'Trang chu',
                            'item' => url('/'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => 'Tin tuc',
                            'item' => url('/tin-tuc'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => $post->title,
                            'item' => $canonical,
                        ],
                    ],
                ],
            ],
        ];
    }
}
