<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::all();
        foreach ($settings as $setting) {
            $value = $request->input('settings.' . $setting->id);

            if ($setting->is_required && empty($value)) {
                return redirect()->back()->with('error', $setting->title . ' is required.');
            }

            $setting->value = $value;
            $setting->save();
        }

        return redirect()->route('admin.settings.index')->with([
            'message' => 'Settings updated successfully!',
            'alert-type' => 'success'
        ]);
    }
}
