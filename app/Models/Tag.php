<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
        'posts_count'
    ];

    protected $casts = [
        'posts_count' => 'integer'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag')
                   ->withTimestamps();
    }

    public function publishedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_tag')
                   ->where('status', 'published')
                   ->where('published_at', '<=', now())
                   ->withTimestamps();
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}