<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return response()->json([
            'status' => 'success',
            'data' => $settings
        ], 200);
    }

    public function update(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Contact Pranali when you integrate',
        ], 200);
    }
}
