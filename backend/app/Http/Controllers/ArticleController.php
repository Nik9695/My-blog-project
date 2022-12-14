<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Utils\StringUtils;
use Illuminate\Support\Facades\Request;

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
    public function index(User $user = null)
    {
        return Article::query()
            ->with('author')
            ->with('categories')
            ->limit(request('limit'))
            ->inCategory(request('category'))
            ->fromUser(request('user_id') ?? $user?->id)
            ->orderBy(request('ordering'), request('direction'))
            ->paginate(request('per_page'))->appends(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();


        if ($request->background_image) {
            $path = $request->file('background_image')->store('images', ['disk' => 'public']);
            if (!$path) {
                return response()->json(['msg' => 'Background image could not be saved'], 500);
            }
            $validated['background_image_path'] = $path;
        }
        $article = new Article($validated);
        $article->user_id = auth()->id();
        $article->slug = StringUtils::slugify($article->title);
        $article->save();
        $article->categories()->attach($request->category_id);
        return $article;
    }

    public function storeBackgroundImage(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Article::with('author')
            ->with('categories')
            ->findOrFail($id);
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
        $validated = $request->validated();

        if ($request->background_image) {
            $path = $request->file('background_image')->store('images', ['disk' => 'public']);

            if (!$path) {
                return response()->json(['msg' => 'background image could not be saved'], 500);
            }

            $validated['background_image_path'] = $path;
        }
        $validated['slug'] = StringUtils::slugify($request->title);

        if (!$article->update($validated)) {
            return response()->json(['msg' => 'could not update user'], 500);
        }
        $article->categories()->sync($request->category_id);

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
        if (!($article->delete())) {
            return response()->json(['message' => 'Article can not be deleted'], 500);
        }
        return response()->json(['message' => 'Article was delted'], 200);
    }
}
