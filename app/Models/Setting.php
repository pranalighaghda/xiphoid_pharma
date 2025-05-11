<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'field_type',
        'is_required',
        'value',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];
}
