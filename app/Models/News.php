<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
        'image',
        'slug',
        'user_id',
        'category_id',
        'is_featured',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'news_user')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }
}
