<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Page;
use App\Models\Section;

class EntryController extends Controller
{
    public function index($page_id, $section_id)
    {
        $page = Page::findOrFail($page_id);
        $section = Section::where('page_id', $page_id)->findOrFail($section_id);
        $entries = Entry::where('section_id', $section_id)->ordered()->get();

        return view('admin.entry.index', compact('section', 'page', 'entries'));
    }

    public function create($page_id, $section_id)
    {
        $page = Page::findOrFail($page_id);
        $section = Section::where('page_id', $page_id)->findOrFail($section_id);

        return view('admin.entry.create', compact('section', 'page'));
    }

    public function store(Request $request, $page_id, $section_id)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'btn_text'       => 'nullable|string|max:255',
            'btn_url'        => 'nullable|string',
            'btn_is_new_tab' => 'nullable|boolean|in:1,0',
            'status'         => 'nullable|in:1,0',
        ]);

        $validated['section_id'] = $section_id;

        $entry = Entry::create(collect($validated)->except('media')->toArray());

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $entry, 'image');
        }

        return redirect()->route('admin.pages.sections.entries.index', ['page_id' => $page_id, 'section_id' => $section_id])->with([
            'message' => 'Entry created successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($page_id, $section_id, $id)
    {
        $page = Page::findOrFail($page_id);
        $section = Section::where('page_id', $page_id)->findOrFail($section_id);
        $entry = Entry::where('section_id', $section_id)->findOrFail($id);

        return view('admin.entry.edit', compact('section', 'page', 'entry'));
    }

    public function update(Request $request, $page_id, $section_id, $id)
    {
        $entry = Entry::where('section_id', $section_id)->findOrFail($id);

        $validated = $request->validate([
            'title'          => 'sometimes|string|max:255',
            'content'        => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'btn_text'       => 'nullable|string|max:255',
            'btn_url'        => 'nullable|string',
            'btn_is_new_tab' => 'nullable|boolean|in:1,0',
            'status'         => 'nullable|in:1,0',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $entry, 'image');
        }

        $entry->update(collect($validated)->except('media')->toArray());

        return redirect()->route('admin.pages.sections.entries.index', ['page_id' => $page_id, 'section_id' => $section_id])->with([
            'message' => 'Entry updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($page_id, $section_id, $id)
    {
        $entry = Entry::where('section_id', $section_id)->findOrFail($id);

        if ($entry->media) {
            MediaHelper::deleteMediaFromModel($entry);
        }

        $entry->delete();

        return response()->json([
            'success' => true,
            'message' => 'Entry deleted successfully.'
        ], 200);
    }

    public function reorder($page_id, $section_id)
    {
        $page = Page::findOrFail($page_id);
        $section = Section::where('page_id', $page_id)->findOrFail($section_id);
        $entries = Entry::where('section_id', $section_id)->ordered()->get();

        return view('admin.entry.reorder', compact('entries', 'page', 'section'));
    }

    public function updateOrder(Request $request, $page_id, $section_id)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|exists:entries,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Entry::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Entries reordered successfully.'
        ], 200);
    }
}
