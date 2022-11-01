<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, options: ['except' => ['index', 'store']]);
    }

    public function index()
    {
        $users = User::paginate(5);
        return $users;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        if ($request->avatar) {
            $path = $request->file('avatar')->store('images/pictures', 's3');
            if (!$path) {
                return response()->json(['msg' => 'avatar could not be saved'], 500);
            }
            $validated['avatar_path'] = $path;
        } else {
            $path = 'public/images/default-user-image.jpg';
            $validated['avatar_path'] = $path;
        }
        $user = new User($validated);
        $user->save();

        return $user;
    }
}
