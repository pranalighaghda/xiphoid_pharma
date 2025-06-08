<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('id', 'desc')->get();

        return view('admin.pages1.index', compact('pages'));
    }

    public function edit($page_id)
    {
        $item = Page::findOrFail($page_id);

        return view('admin.pages1.edit', compact('item'));
    }

    public function update(Request $request, $page_id)
    {
        $item = Page::findOrFail($page_id);

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'small_desc'    => 'nullable|string',
            'media'         => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title'    => 'nullable|string|max:255',
            'meta_content'  => 'nullable|string',
            'meta_keyword'  => 'nullable|string',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $item, 'image');
        }

        $item->update(collect($validated)->except('media')->toArray());

        return redirect()->route('admin.pages.index')->with([
            'message' => 'Page updated successfully!',
            'alert-type' => 'success'
        ]);
    }
}
