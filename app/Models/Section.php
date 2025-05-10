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
        'media',
        'btn_text',
        'btn_url',
        'btn_is_new_tab',
        'is_entries',
        'status',
    ];

    // Relationships
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
