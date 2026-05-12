<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return Inertia::render('Admin/Settings', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        $imageFields = [
            'site_logo_upload' => 'site_logo',
            'site_favicon_upload' => 'site_favicon',
            'floating_zalo_image_upload' => 'floating_zalo_image',
            'floating_messenger_image_upload' => 'floating_messenger_image',
            'floating_facebook_image_upload' => 'floating_facebook_image',
            'dmca_image_upload' => 'dmca_image',
        ];

        foreach ($imageFields as $fileField => $settingKey) {
            if ($request->hasFile($fileField)) {
                $path = $request->file($fileField)->store('uploads/settings', 'public');
                $data[$settingKey] = $request->getSchemeAndHttpHost().'/storage/'.$path;
            }

            unset($data[$fileField]);
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Cập nhật cấu hình thành công!');
    }
}
