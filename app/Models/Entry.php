<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'small_desc',
        'media',
        'sort_order',
        'status',
    ];

    protected $appends = ['media_url', 'media_id'];

    // Relationships
    public function section()
    {
        return $this->belongsTo(Section::class);
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

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
