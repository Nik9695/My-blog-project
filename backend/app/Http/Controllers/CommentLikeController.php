<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
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
    public function index(Comment $comment)
    {
        $likes = Like::where('comment_id', $comment->id)->get();
        return $likes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Comment $comment)
    {

        $likes = Like::all();

        if ($likes->contains('comment_id', $comment->id) && $likes->contains('user_id', auth()->id())) {
            return 'you have already put like on this comment';
        } else {
            $like = new Like(['like_status' => true]);

            $like->like_status = true;
            $like->user_id = auth()->id();

            $like->comment_id = $comment->id;
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
        if ($like->delete()) {
            return 'like has been removed';
        }
    }
}
