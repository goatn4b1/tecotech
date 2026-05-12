<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $settings = Schema::hasTable('settings')
            ? \App\Models\Setting::all()->pluck('value', 'key')
            : [];

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
            'globalSettings' => (object) $settings,
            'seoDefaults' => [
                'title' => $settings['home_meta_title'] ?? 'Tecotech - Tổng thầu EPC Xử lý môi trường & Gia công cơ khí',
                'description' => $settings['home_meta_description'] ?? 'Tecotech chuyên cung cấp giải pháp tổng thầu EPC hệ thống xử lý nước thải, khí thải và gia công cơ khí phi tiêu chuẩn chất lượng cao.',
                'keywords' => $settings['home_meta_keywords'] ?? 'xử lý môi trường, gia công cơ khí, xử lý nước thải, tecotech, cơ khí môi trường',
                'image' => $settings['home_og_image'] ?? asset('images/logo.png'),
                'favicon' => $settings['site_favicon'] ?? asset('favicon.ico'),
                'canonical' => $settings['home_canonical_url'] ?? null,
                'robots' => $settings['home_meta_robots'] ?? 'index, follow',
            ],
            'globalMenus' => Schema::hasTable('menus')
                ? \App\Models\Menu::with('children')->whereNull('parent_id')->orderBy('order')->get()
                : [],
        ];
    }
}
