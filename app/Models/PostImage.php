<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'filename',
        'original_name',
        'path',
        'url',
        'mime_type',
        'size',
        'width',
        'height',
        'alt_text',
        'caption',
        'sort_order',
        'is_featured'
    ];

    protected $casts = [
        'size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'sort_order' => 'integer',
        'is_featured' => 'boolean'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}