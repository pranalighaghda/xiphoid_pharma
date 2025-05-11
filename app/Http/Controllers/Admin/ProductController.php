<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\MediaHelper;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::ordered()->get();

        return response()->json([
            'success' => true,
            'message' => 'Products fetched successfully.',
            'data' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product fetched successfully.',
            'data' => $product
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'composition'   => 'nullable|string|max:255',
            'dosage_form'   => 'nullable|string|max:255',
            'pack_type'     => 'nullable|string|max:255',
            'pack_style'    => 'nullable|string|max:255',
            'strength'      => 'nullable|string|max:255',
            'status'        => 'nullable|in:0,1',
            'media'         => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::create($validated);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $product, 'image');
        }

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data' => $product->fresh()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'composition'   => 'nullable|string|max:255',
            'dosage_form'   => 'nullable|string|max:255',
            'pack_type'     => 'nullable|string|max:255',
            'pack_style'    => 'nullable|string|max:255',
            'strength'      => 'nullable|string|max:255',
            'status'        => 'nullable|in:0,1',
            'media'         => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $product, 'image');
        }

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => $product->fresh()
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        if ($product->media) {
            MediaHelper::deleteMediaFromModel($product);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ], 200);
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|exists:products,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Product::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Products reordered successfully.',
        ], 200);
    }
}
