<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function index($page_id)
    {
        $page = Page::findOrFail($page_id);
        $sections = Section::where('page_id', $page_id)->get();

        return view('admin.section.index', compact('sections', 'page'));
    }

    public function edit($page_id, $id)
    {
        $page = Page::findOrFail($page_id);
        $item = Section::where('page_id', $page_id)->findOrFail($id);

        return view('admin.section.edit', compact('item', 'page'));
    }

    public function update(Request $request, $page_id, $id)
    {
        $page = Page::findOrFail($page_id);
        $item = Section::where('page_id', $page_id)->findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'small_desc' => 'nullable|string',
            'content' => 'nullable|string',
            'media'         => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'btn_text' => 'nullable|string|max:255',
            'btn_url' => 'nullable|url',
            'btn_is_new_tab' => 'nullable|boolean|in:1,0',
            'status' => 'nullable|in:1,0',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $item, 'image');
        }

        $item->update(collect($validated)->except('media')->toArray());

        return redirect(route('admin.pages.sections.index', ['page_id' => $page->id]));
    }
}
