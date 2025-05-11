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
    ];

    protected $appends = ['media_url'];

    // Relationships
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

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
}
