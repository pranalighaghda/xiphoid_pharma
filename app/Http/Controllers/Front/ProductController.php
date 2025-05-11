<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function products($category_id = null)
    {
        if ($category_id != null) {
            $products = Product::where('category_id', $category_id)
                ->ordered()
                ->get();
            $return_msg = "Category products fetched successfully.";
        } else {
            $products = Product::active()
                ->active()
                ->ordered()
                ->get();

            $return_msg = "Products fetched successfully.";
        }

        return response()->json([
            'success' => true,
            'message' => $return_msg,
            'data' => $products
        ], 200);
    }
}
