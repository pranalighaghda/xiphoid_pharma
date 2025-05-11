<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait HasMediaTrait
{
    // A helper method for saving media
    private function saveMediaAttributes(UploadedFile $file, $model, string $fileType): array
    {
        $folder = 'uploads/' . strtolower(class_basename($model));

        $filename = now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs($folder, $filename, 'public');

        // If file is an image, get its width and height
        $height = null;
        $width = null;

        if (in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
            [$width, $height] = getimagesize($file->getRealPath());
        }

        return [
            'file_name'  => $filename,
            'file_path'  => $path,
            'file_type'  => $fileType,
            'mime_type'  => $file->getClientMimeType(),
            'file_size'  => $file->getSize(),
            'height'     => $height,
            'width'      => $width,
        ];
    }

    public function attachMedia(UploadedFile $file, $model, string $fileType = 'file'): Media
    {
        $mediaData = $this->saveMediaAttributes($file, $model, $fileType);

        return $model->media()->create($mediaData);
    }

    public function updateMedia(UploadedFile $file, Media $media, string $fileType = 'file'): Media
    {
        // Delete old file if it exists
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $mediaData = $this->saveMediaAttributes($file, $media->mediable, $fileType);

        $media->update($mediaData);

        return $media;
    }

    public function deleteMedia(Media $media): void
    {
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();
    }
}
