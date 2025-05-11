<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Helpers\MediaHelper;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::ordered()->get();

        return response()->json([
            'success' => true,
            'message' => 'Banners fetched successfully.',
            'data' => $banners
        ], 200);
    }

    public function show($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Banner fetched successfully.',
            'data' => $banner
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'nullable|string|max:255',
            'small_desc'  => 'nullable|string',
            'sort_order'  => 'nullable|integer',
            'status'      => 'nullable|in:0,1',
            'media'       => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $banner = Banner::create($validated);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $banner, 'image');
        }

        return response()->json([
            'success' => true,
            'message' => 'Banner created successfully.',
            'data' => $banner
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner not found.'
            ], 404);
        }

        $hasMedia = $banner->media()->exists();

        $validated = $request->validate([
            'title'       => 'nullable|string|max:255',
            'small_desc'  => 'nullable|string',
            'sort_order'  => 'nullable|integer',
            'status'      => 'nullable|in:0,1',
            'media'       => $hasMedia ? 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048' : 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $banner, 'image');
        }

        $banner->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Banner updated successfully.',
            'data' => $banner
        ], 200);
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner not found.'
            ], 404);
        }

        if ($banner->media) {
            MediaHelper::deleteMediaFromModel($banner);
        }

        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner deleted successfully.'
        ], 200);
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|exists:banners,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Banner::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Banners reordered successfully.',
        ], 200);
    }
}
