<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Utils\StringUtils;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, options: ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all()->load(['user'])->load(['comments']);

        $sortedArticles = $articles->sortBy(function ($item) {
            return strlen(trim($item['title']));
        });

        return $sortedArticles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = new Article($request->validated());
        $article->user_id = auth()->id();
        $article->slug = StringUtils::slugify($article->title);
        $article->save();
        return $article;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->validated());
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ($article->delete()) {
            return 'Article was deleted';
        }
    }
}
//Et sit aut enim necessitatibus cum consequuntur.
//Dolor neque harum sequi ullam quam voluptatum.



//Qui repellat iste quia ut mollitia.
//Unde non rerum suscipit ut tenetur.


//Dolorem omnis praesentium vel quae tempora.
//Vero sed voluptatibus fuga dolor distinctio.
