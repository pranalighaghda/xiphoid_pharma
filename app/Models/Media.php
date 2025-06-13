<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'mime_type',
        'file_size',
        'height',
        'width',
        'mediable_id',
        'mediable_type',
    ];

    public function getUrlAttribute(): string
    {
        return asset($this->file_path);
    }


    public function mediable()
    {
        return $this->morphTo();
    }
}
