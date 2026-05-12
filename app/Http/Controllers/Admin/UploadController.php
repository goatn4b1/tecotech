<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        try {
            $request->validate([
                'upload' => 'nullable|image|max:5120',
                'image' => 'nullable|image|max:5120',
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => collect($exception->errors())->flatten()->first() ?: 'Ảnh tải lên không hợp lệ.',
                ],
            ], 422);
        }

        $file = $request->file('upload') ?: $request->file('image');

        if (! $file) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Không tìm thấy file ảnh tải lên.',
                ],
            ], 422);
        }

        $path = $file->store('uploads/images', 'public');

        return response()->json([
            'uploaded' => 1,
            'fileName' => $file->hashName(),
            'url' => $request->getSchemeAndHttpHost().'/storage/'.$path,
        ]);
    }
}
