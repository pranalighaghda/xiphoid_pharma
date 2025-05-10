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

    // Relationships
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
