<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::ordered()->get();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'small_desc'     => 'nullable|string',
            'content'        => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'status'         => 'nullable|in:1,0',
        ]);

        $category = Category::create(collect($validated)->except('media')->toArray());

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $category, 'image');
        }

        return redirect()->route('admin.categories.index')->with([
            'message' => 'Category created successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'sometimes|string|max:255',
            'small_desc'     => 'nullable|string',
            'content'        => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'status'         => 'nullable|in:1,0',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $category, 'image');
        }

        $category->update(collect($validated)->except('media')->toArray());

        return redirect()->route('admin.categories.index')->with([
            'message' => 'Category updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->media) {
            MediaHelper::deleteMediaFromModel($category);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ], 200);
    }

    public function reorder()
    {
        $categories = Category::ordered()->get();

        return view('admin.category.reorder', compact('categories'));
    }

    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|exists:categories,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Category::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Categories reordered successfully.'
        ], 200);
    }
}
