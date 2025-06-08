<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function enquiry(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone_no'   => 'nullable|max:255',
            'subject'    => 'required|string|max:255',
            'content'    => 'required|string|max:1000',
        ]);

        $enquiry = Enquiry::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Your enquiry has been submitted successfully.',
            'data' => $enquiry
        ], 200);
    }
}
