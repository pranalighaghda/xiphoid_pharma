<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Page;

class PageController extends Controller
{
    public function page($page_name)
    {
        $page = Page::with([
            'sections' => fn($q) => $q->active(),
            'sections.entries' => fn($q) => $q->ordered()->active(),
        ])
            ->where('name', $page_name)->firstOrFail();

        if ($page_name == 'home') {
            $page['banners'] = Banner::active()->ordered()->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Page fetched successfully.',
            'data' => $page
        ], 200);
    }
}
