<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Comment::class, options: ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        $comments = Comment::where('article_id', $article->id)->paginate(5);
        return $comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $comment = new Comment(['content' => $request->content]);
        $comment->user_id = $article->user_id;
        $comment->article_id = $article->id;
        $comment->save();

        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
