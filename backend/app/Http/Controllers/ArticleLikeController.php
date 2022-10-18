<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

class ArticleLikeController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Like::class, options: ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        $likes = Like::where('article_id', $article->id)->get();
        return $likes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLikeRequest $request, Article $article)
    {

        $likes = Like::all();

        if ($likes->contains('article_id', $article->id) && $likes->contains('user_id', auth()->id())) {
            return 'you have already put like';
        } else {
            $like = new Like(['like_status' => true]);

            $like->like_status = true;
            $like->user_id = auth()->id();

            $like->article_id = $article->id;
            $like->save();

            return $like;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //dd('qweqw');
        if ($like->delete()) {
            return 'like has been removed';
        }
    }
}
