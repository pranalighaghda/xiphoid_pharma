<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings(Request $request)
    {
        $settings = Setting::all()->pluck('value', 'name');

        $settings['logo'] = asset('images/logo.png');
        $settings['favicon'] = asset('images/icon_logo.png');
        $settings['color'] = '#0e529e';

        $activePages = Page::where('status', 1)
            ->select('id', 'name', 'title')
            ->get();

        $activePages = Page::all()->pluck('status', 'name');


        $settings['pages'] = $activePages;

        return response()->json([
            'success' => true,
            'message' => 'Settings fetched successfully.',
            'data' => $settings
        ], 200);
    }
}
