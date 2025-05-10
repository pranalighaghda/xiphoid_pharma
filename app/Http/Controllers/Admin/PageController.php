<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::select('id', 'name', 'title', 'is_sections')->get();

        return response()->json([
            'success' => true,
            'message' => 'Pages fetched successfully.',
            'data' => $pages
        ], 200);
    }

    public function show($id)
    {
        $page = Page::find($id);

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Page fetched successfully.',
            'data' => $page
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found.'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'small_desc' => 'nullable|string',
            'media' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_content' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        $page->update($validated);
        $page->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Page updated successfully.',
            'data' => $page
        ], 200);
    }
}
