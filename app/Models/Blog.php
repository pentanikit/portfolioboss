<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    // (Optional) If your table name is non-standard, uncomment:
    // protected $table = 'blogs';

    /**
     * Mass-assignable attributes.
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'image',
        'author_id',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Route model binding by slug (optional but handy).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relationships.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Query scopes.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'published')
                     ->whereNull('published_at')
                     ->orWhere('published_at', '>', now());
    }
}

