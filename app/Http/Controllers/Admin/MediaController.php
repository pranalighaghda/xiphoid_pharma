<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\HasMediaTrait;

class MediaController extends Controller
{
    use HasMediaTrait;

    public function destroy($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'status' => false,
                'message' => 'Media not found.',
            ], 404);
        }

        $this->deleteMedia($media);

        return response()->json([
            'status' => true,
            'message' => 'Media deleted successfully.',
        ]);
    }
}
