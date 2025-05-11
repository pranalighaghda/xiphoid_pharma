<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Entry;

class EntryController extends Controller
{
    public function index($page_id, $section_id)
    {
        $entries = Entry::where('section_id', $section_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Entries fetched successfully.',
            'data' => $entries
        ], 200);
    }

    public function show($page_id, $section_id, $id)
    {
        $entry = Entry::where('section_id', $section_id)->find($id);

        if (!$entry) {
            return response()->json([
                'success' => false,
                'message' => 'Entry not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Entry fetched successfully.',
            'data' => $entry
        ], 200);
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

        return response()->json([
            'success' => true,
            'message' => 'Entry created successfully.',
            'data' => $entry->fresh()
        ], 200);
    }

    public function update(Request $request, $page_id, $section_id, $id)
    {
        $entry = Entry::where('section_id', $section_id)->find($id);

        if (!$entry) {
            return response()->json([
                'success' => false,
                'message' => 'Entry not found.'
            ], 404);
        }

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

        return response()->json([
            'success' => true,
            'message' => 'Entry updated successfully.',
            'data' => $entry->fresh()
        ], 200);
    }

    public function destroy($page_id, $section_id, $id)
    {
        $entry = Entry::where('section_id', $section_id)->find($id);

        if (!$entry) {
            return response()->json([
                'success' => false,
                'message' => 'Entry not found.'
            ], 404);
        }

        if ($entry->media) {
            MediaHelper::deleteMediaFromModel($entry);
        }

        $entry->delete();

        return response()->json([
            'success' => true,
            'message' => 'Entry deleted successfully.'
        ], 200);
    }
}
