<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Section;

class SectionController extends Controller
{
    public function index($page_id)
    {
        $sections = Section::where('page_id', $page_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Page Sections fetched successfully.',
            'data' => $sections
        ], 200);
    }

    public function show($page_id, $id)
    {
        $section = Section::where('page_id', $page_id)->find($id);

        if (!$section) {
            return response()->json([
                'success' => false,
                'message' => 'Section not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Section fetched successfully.',
            'data' => $section
        ], 200);
    }

    public function update(Request $request, $page_id, $id)
    {
        $section = Section::where('page_id', $page_id)->find($id);

        if (!$section) {
            return response()->json([
                'success' => false,
                'message' => 'Section not found.'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'small_desc' => 'nullable|string',
            'content' => 'nullable|string',
            'media'         => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'btn_text' => 'nullable|string|max:255',
            'btn_url' => 'nullable|string',
            'btn_is_new_tab' => 'nullable|boolean|in:1,0',
            'status' => 'nullable|in:1,0',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $section, 'image');
        }

        $section->update(collect($validated)->except('media')->toArray());

        return response()->json([
            'success' => true,
            'message' => 'Section updated successfully.',
            'data' => $section->fresh()
        ], 200);
    }
}
