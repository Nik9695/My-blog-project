<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }


    public function scopeFromArticle($builder, $article_id)
    {
        if ($article_id === null) {
            return $builder;
        }

        return $builder->where('article_id', $article_id);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
