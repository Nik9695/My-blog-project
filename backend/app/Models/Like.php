<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['like_status', 'user_id', 'article_id', 'comment_id'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
