<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::ordered()->get();

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::ordered()->get();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'composition'    => 'nullable|string',
            'dosage_form'    => 'nullable|string',
            'pack_type'      => 'nullable|string',
            'pack_style'     => 'nullable|string',
            'strength'       => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'status'         => 'nullable|in:1,0',
        ]);

        $product = Product::create(collect($validated)->except('media')->toArray());

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $product, 'image');
        }

        return redirect()->route('admin.products.index')->with([
            'message' => 'Product created successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'sometimes|string|max:255',
            'composition'    => 'nullable|string',
            'dosage_form'    => 'nullable|string',
            'pack_type'      => 'nullable|string',
            'pack_style'     => 'nullable|string',
            'strength'       => 'nullable|string',
            'media'          => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'status'         => 'nullable|in:1,0',
        ]);

        if ($request->hasFile('media')) {
            MediaHelper::syncMediaToModel($request->file('media'), $product, 'image');
        }

        $product->update(collect($validated)->except('media')->toArray());

        return redirect()->route('admin.products.index')->with([
            'message' => 'Product updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->media) {
            MediaHelper::deleteMediaFromModel($product);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ], 200);
    }

    public function reorder()
    {
        $products = Product::ordered()->get();

        return view('admin.product.reorder', compact('products'));
    }

    public function updateOrder(Request $request)
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
            'message' => 'Products reordered successfully.'
        ], 200);
    }
}
