<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::whereHas('products', function ($query) {
            $query->active();
        })
            ->active()
            ->ordered()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Categories fetched successfully.',
            'data' => $categories
        ], 200);
    }
}
