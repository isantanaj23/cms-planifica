<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    // Usar tabla blog_posts existente
    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'category_id',
        'user_id',
        'status',
        'published_at',
        'scheduled_at',
        'views_count',
        'likes_count',
        'reading_time',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'allow_comments'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'is_featured' => 'boolean',
        'allow_comments' => 'boolean',
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'reading_time' => 'integer'
    ];

    // Relaciones
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_post_tag', 'blog_post_id', 'tag_id')
                   ->withTimestamps();
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => '<span class="badge bg-secondary">Borrador</span>',
            'published' => '<span class="badge bg-success">Publicado</span>',
            'scheduled' => '<span class="badge bg-warning">Programado</span>',
            'archived' => '<span class="badge bg-dark">Archivado</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-light">Desconocido</span>';
    }

    public function getReadingTimeTextAttribute()
    {
        $time = $this->reading_time ?? 1;
        return $time . ' min de lectura';
    }

    public function getPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : null;
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%");
        });
    }

    // Métodos
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isPublished()
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    public function canBePublished()
    {
        return in_array($this->status, ['draft', 'scheduled']);
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }
}