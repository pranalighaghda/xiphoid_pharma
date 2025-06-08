<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::orderBy('created_at', 'desc')->get();

        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Enquiry fetched successfully.',
            'data' => $enquiry
        ], 200);
    }

    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $enquiry->delete();

        return response()->json([
            'success' => true,
            'message' => 'Enquiry deleted successfully.'
        ], 200);
    }
}
