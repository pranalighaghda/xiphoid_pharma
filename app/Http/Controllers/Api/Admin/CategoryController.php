<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\MediaHelper;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::ordered()->get();

        return response()->json([
            'success' => true,
            'message' => 'Categories fetched successfully.',
            'data' => $categories
        ], 200);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category fetched successfully.',
            'data' => $category
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'small_desc'  => 'nullable|string',
            'content'     => 'nullable|string',
            'status'      => 'nullable|in:0,1',
            'media'       => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $category = Category::create($validated);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $category, 'image');
        }

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data' => $category->fresh()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        $hasMedia = $category->media()->exists();

        $validated = $request->validate([
            'title'       => 'nullable|string|max:255',
            'small_desc'  => 'nullable|string',
            'content'     => 'nullable|string',
            'status'      => 'nullable|in:0,1',
            'media'       => $hasMedia ? 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048' : 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $category, 'image');
        }

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data' => $category->fresh()
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        $products = Product::where('category_id', $category->id)->get();

        foreach ($products as $product) {
            if ($product->media) {
                MediaHelper::deleteMediaFromModel($product);
            }

            $product->delete();
        }

        if ($category->media) {
            MediaHelper::deleteMediaFromModel($category);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ], 200);
    }

    public function reorder(Request $request)
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
            'message' => 'Categories reordered successfully.',
        ], 200);
    }
}
