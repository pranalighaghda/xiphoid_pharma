<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'name',
        'title',
        'small_desc',
        'content',
        'btn_text',
        'btn_url',
        'btn_is_new_tab',
        'is_entries',
        'status',
    ];

    protected $appends = ['media_url', 'media_id'];

    // Relationships
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
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

    public function getMediaIdAttribute(): ?int
    {
        $media = $this->relationLoaded('media') ? $this->media : $this->media()->get();

        return $media->isNotEmpty()
            ? $media->first()->id
            : null;
    }
}
