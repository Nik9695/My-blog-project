<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReactionRequest;
use App\Http\Requests\UpdateReactionRequest;
use App\Models\Article;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;

class ArticleReactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        return $article->reactions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReactionRequest $request, Article $article)
    {
        $reaction = new Reaction($request->validated());
        $reaction->user_id = Auth::user()->id;
        $reaction->reactable_id = $article->id;
        $reaction->reactable_type = 'article';
        $reaction->save();

        if (!$reaction->save()) {
            return response()->json(['message' => 'It was impossible to save reaction'], 500);
        }
        return response()->json($reaction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show(Reaction $reaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReactionRequest  $request
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReactionRequest $request, Reaction $reaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reaction $reaction)
    {
        //
    }
}
