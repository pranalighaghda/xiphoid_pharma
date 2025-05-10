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
        'media',
        'meta_title',
        'meta_content',
        'meta_keyword',
        'is_sections',
    ];

    // Relationships
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
