<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'small_desc',
        'meta_title',
        'meta_content',
        'meta_keyword',
        'is_sections',
        'status'
    ];

    protected $appends = ['media_url', 'media_id'];

    // Relationships
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    // Accessor
    public function getMediaUrlAttribute(): ?string
    {
        $media = $this->relationLoaded('media') ? $this->media : $this->media()->get();

        return $media->isNotEmpty()
            ? $media->first()->url
            : null;
    }

    public function getMediaIdAttribute(): ?int
    {
        $media = $this->relationLoaded('media') ? $this->media : $this->media()->get();

        return $media->isNotEmpty()
            ? $media->first()->id
            : null;
    }
}
