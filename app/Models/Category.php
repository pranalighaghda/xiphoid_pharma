<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'small_desc',
        'content',
        'sort_order',
        'status',
    ];

    protected $appends = ['media_url'];

    public function media()
    {
        return $this->morphMany(\App\Models\Media::class, 'mediable');
    }

    // Accessor
    public function getMediaUrlAttribute(): ?string
    {
        $media = $this->relationLoaded('media') ? $this->media : $this->media()->get();

        return $media->isNotEmpty()
            ? $media->first()->url
            : null;
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
