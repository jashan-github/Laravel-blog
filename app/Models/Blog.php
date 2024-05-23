<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
        'published_at',
    ];

    const ACTIVE=1;
    const INACTIVE=0;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class, 'blog_tags')->withTimestamps();
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, $searchVal)
    {
        if ($searchVal === null) return $query;

        return $query->where('title', 'like', '%' . $searchVal .  '%');
    }
}
