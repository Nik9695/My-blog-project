<?php

namespace App\Models;

use App\Utils\StringUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'user_id'];

    public function getRouteKeyName()
    {
        return 'id';
    }

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
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
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

    public function scopeCategory($builder, $category)
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
}
