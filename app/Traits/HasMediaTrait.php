<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\UploadedFile;

trait HasMediaTrait
{
    private function saveMediaAttributes(UploadedFile $file, $model, string $fileType): array
    {
        $folder = 'uploads/' . strtolower(class_basename($model));

        $filename = now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destination = public_path($folder);

        if (!file_exists($destination)) {
            mkdir($destination, 0775, true);
        }

        $targetPath = $destination . '/' . $filename;

        if ($file->isValid()) {
            $file->move($destination, $filename);
        }

        $height = null;
        $width = null;
        $fileSize = file_exists($targetPath) ? filesize($targetPath) : 0;

        if (in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
            [$width, $height] = getimagesize($targetPath);
        }

        return [
            'file_name'  => $filename,
            'file_path'  => $folder . '/' . $filename, // includes "uploads/..."
            'file_type'  => $fileType,
            'mime_type'  => $file->getClientMimeType(),
            'file_size'  => $fileSize,
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
        $existingPath = public_path($media->file_path);
        if (file_exists($existingPath)) {
            unlink($existingPath);
        }

        $mediaData = $this->saveMediaAttributes($file, $media->mediable, $fileType);
        $media->update($mediaData);

        return $media;
    }

    public function deleteMedia(Media $media): void
    {
        $existingPath = public_path($media->file_path);
        if (file_exists($existingPath)) {
            unlink($existingPath);
        }

        $media->delete();
    }
}
