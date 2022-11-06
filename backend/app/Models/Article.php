<?php

namespace App\Models;

use App\Utils\StringUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'user_id', 'background_image_path'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    protected function setTitleAttribute(string $title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = StringUtils::slugify($title);
    }

    public function scopeInCategory($builder, $category)
    {
        if ($category === null) {
            return $builder;
        }

        return $builder->with('categories')->whereHas('categories', function ($currentQuery) use ($category) {
            $currentQuery->where('slug', $category);
        });
    }

    public function scopeNewest($builder)
    {
        return $builder->orderBy('created_at', 'desc');
    }

    public function scopeFromUser($builder, $user_id)
    {
        if ($user_id === null) {
            return $builder;
        }

        return $builder->where('user_id', $user_id);
    }

    public function getBackgroundImagePathAttribute($value)
    {
        return asset($value ? asset('storage/' . $value) : 'http://localhost:8000/storage/images/default-article-background.jpg');
    }
}
