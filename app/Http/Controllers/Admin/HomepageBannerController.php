<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class HomepageBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();

        return view('admin.homepage-banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.homepage-banner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'small_desc'     => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'status'         => 'nullable|in:1,0',
        ]);

        $banner = Banner::create(collect($validated)->except('media')->toArray());

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $banner, 'image');
        }

        return redirect()->route('admin.homepage-banner.index')->with([
            'message' => 'Banner created successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        return view('admin.homepage-banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'sometimes|string|max:255',
            'small_desc'     => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'status'         => 'nullable|in:1,0',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $banner, 'image');
        }

        $banner->update(collect($validated)->except('media')->toArray());

        return redirect()->route('admin.homepage-banner.index')->with([
            'message' => 'Banner updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->media) {
            MediaHelper::deleteMediaFromModel($banner);
        }

        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner deleted successfully.'
        ], 200);
    }

    public function reorder()
    {
        $banners = Banner::ordered()->get();

        return view('admin.homepage-banner.reorder', compact('banners'));
    }

    public function updateOrder(Request $request)
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
            'message' => 'Banners reordered successfully.'
        ], 200);
    }
}
