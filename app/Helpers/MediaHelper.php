<?php

namespace App\Helpers;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use App\Traits\HasMediaTrait;

class MediaHelper
{
    use HasMediaTrait;

    public static function attachMediaToModel(UploadedFile $file, $model, string $fileType = 'file'): Media
    {
        return (new self)->attachMedia($file, $model, $fileType);
    }

    public static function updateMediaForModel(UploadedFile $file, Media $media, string $fileType = 'file'): Media
    {
        return (new self)->updateMedia($file, $media, $fileType);
    }

    public static function deleteMediaFromModel($model): void
    {
        $existingMedia = $model->media()->first();
        (new self)->deleteMedia($existingMedia);
    }

    public static function syncMediaToModel(UploadedFile $file, $model, string $fileType = 'file'): Media
    {
        $existingMedia = $model->media()->first();

        return $existingMedia
            ? self::updateMediaForModel($file, $existingMedia, $fileType)
            : self::attachMediaToModel($file, $model, $fileType);
    }
}
