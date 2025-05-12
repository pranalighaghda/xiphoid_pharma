<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $replyStatus = $request->boolean('reply_status', null); // returns null, true, or false

        $query = Enquiry::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('subject', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            });
        }

        if (!is_null($replyStatus)) {
            $replyStatus ? $query->whereNotNull('reply_note') : $query->whereNull('reply_note');
        }

        $enquiries = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Enquiries fetched successfully.',
            'data' => $enquiries->items(),
            'meta' => [
                'current_page' => $enquiries->currentPage(),
                'last_page' => $enquiries->lastPage(),
                'per_page' => $enquiries->perPage(),
                'total' => $enquiries->total()
            ]
        ]);
    }


    public function reply(Request $request, $id)
    {
        $enquiry = Enquiry::find($id);

        if (!$enquiry) {
            return response()->json([
                'success' => false,
                'message' => 'Enquiry not found.'
            ], 404);
        }

        $validated = $request->validate([
            'reply_note' => 'required|string',
        ]);

        $enquiry->update([
            'reply_note' => $validated['reply_note']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reply saved successfully.',
            'data' => $enquiry->fresh()
        ], 200);
    }
}
