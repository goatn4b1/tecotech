<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        $parentMenus = Menu::whereNull('parent_id')->get();
        
        return Inertia::render('Admin/Menus', [
            'menus' => $menus,
            'parentMenus' => $parentMenus
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'integer'
        ]);

        Menu::create($request->all());

        return redirect()->back()->with('success', 'Thêm menu thành công!');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'integer'
        ]);

        $menu->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật menu thành công!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->back()->with('success', 'Xóa menu thành công!');
    }
}
