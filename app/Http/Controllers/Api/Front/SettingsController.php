<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings(Request $request)
    {
        $settings = Setting::all()->pluck('value', 'name');

        return response()->json([
            'success' => true,
            'message' => 'Settings fetched successfully.',
            'data' => $settings
        ], 200);
    }
}
