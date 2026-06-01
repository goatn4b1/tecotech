<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeSectionController extends Controller
{
    public function index()
    {
        $sections = HomeSection::orderBy('order')->get();
        return Inertia::render('Admin/HomeBuilder', [
            'sections' => $sections,
            'productCategories' => ProductCategory::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:home_sections,id',
            'sections.*.order' => 'required|integer',
        ]);

        foreach ($request->sections as $sectionData) {
            HomeSection::where('id', $sectionData['id'])->update(['order' => $sectionData['order']]);
        }

        return redirect()->back()->with('success', 'Đã lưu thứ tự hiển thị!');
    }

    public function updateData(Request $request, HomeSection $section)
    {
        $request->validate([
            'data' => 'required|array'
        ]);

        $section->update(['data' => $request->data]);

        return redirect()->back()->with('success', 'Đã cập nhật nội dung!');
    }

    public function toggleActive(HomeSection $section)
    {
        $section->update(['is_active' => !$section->is_active]);
        return redirect()->back()->with('success', 'Đã thay đổi trạng thái!');
    }
}
