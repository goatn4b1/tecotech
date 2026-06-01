<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

Route::get('/', function () {
    $sections = Schema::hasTable('home_sections')
        ? \App\Models\HomeSection::where('is_active', true)->orderBy('order')->get()
        : collect();
    $featuredPosts = Schema::hasTable('posts')
        ? \App\Models\Post::with('categoryRelation')->where('is_active', true)->latest()->limit(6)->get()
        : collect();

    return Inertia::render('Home', [
        'sections' => $sections,
        'featuredPosts' => $featuredPosts,
    ]);
});

$renderPageOr = function (string $slug, string $component, array $props = []) {
    $page = \App\Models\Page::where('slug', $slug)->where('is_active', true)->first();

    return $page
        ? Inertia::render('Page', ['pageItem' => $page])
        : Inertia::render($component, $props);
};

Route::get('/gioi-thieu', fn () => $renderPageOr('gioi-thieu', 'About'));

Route::get('/lien-he', function () {
    return Inertia::render('Contact');
});

Route::get('/moi-truong', fn () => $renderPageOr('moi-truong', 'Services', [
    'title' => 'Tổng thầu EPC về môi trường',
    'subtitle' => 'Giải pháp tối ưu cho xử lý nước thải, khí thải và nước cấp.',
]));

Route::get('/gia-cong-co-khi', fn () => $renderPageOr('gia-cong-co-khi', 'Services', [
    'title' => 'Gia công cơ khí',
    'subtitle' => 'Chế tạo thiết bị cơ khí phi tiêu chuẩn chất lượng cao.',
]));

Route::get('/cong-trinh', fn () => $renderPageOr('cong-trinh', 'Projects'));

Route::get('/tin-tuc', function () {
    $posts = \App\Models\Post::with('categoryRelation')->where('is_active', true)->orderBy('created_at', 'desc')->get();

    return Inertia::render('News', [
        'posts' => $posts,
    ]);
});

Route::get('/tin-tuc/{slug}', [\App\Http\Controllers\PageController::class, 'post'])->name('posts.show');

Route::get('/sitemap', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'xml'])->name('sitemap.xml');
Route::get('/robots.txt', function () {
    return response(
        "User-agent: *\n".
        "Allow: /\n".
        "Sitemap: ".route('sitemap.xml')."\n",
        200,
        ['Content-Type' => 'text/plain']
    );
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::post('/uploads/images', [\App\Http\Controllers\Admin\UploadController::class, 'image'])->name('uploads.images');
    Route::post('/ckfinder/upload', [\App\Http\Controllers\Admin\UploadController::class, 'image'])->name('ckfinder.upload');
    Route::post('/maintenance/clear-cache', [\App\Http\Controllers\Admin\MaintenanceController::class, 'clearCache'])->name('maintenance.clear-cache');
    Route::post('/maintenance/build-assets', [\App\Http\Controllers\Admin\MaintenanceController::class, 'buildAssets'])->name('maintenance.build-assets');

    Route::get('/menus', [\App\Http\Controllers\Admin\MenuController::class, 'index'])->name('menus.index');
    Route::post('/menus', [\App\Http\Controllers\Admin\MenuController::class, 'store'])->name('menus.store');
    Route::patch('/menus/{menu}', [\App\Http\Controllers\Admin\MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [\App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('menus.destroy');

    Route::get('/home-builder', [\App\Http\Controllers\Admin\HomeSectionController::class, 'index'])->name('home-builder.index');
    Route::post('/home-builder/order', [\App\Http\Controllers\Admin\HomeSectionController::class, 'updateOrder'])->name('home-builder.order');
    Route::patch('/home-builder/{section}', [\App\Http\Controllers\Admin\HomeSectionController::class, 'updateData'])->name('home-builder.update');
    Route::patch('/home-builder/{section}/toggle', [\App\Http\Controllers\Admin\HomeSectionController::class, 'toggleActive'])->name('home-builder.toggle');

    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->except(['show']);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class)->except(['show']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('product-categories', \App\Http\Controllers\Admin\ProductCategoryController::class)->except(['show']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->where('slug', '^(?!admin|login|register|logout|storage).+');
