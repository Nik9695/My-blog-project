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
        $user = new User($request->validated());
        $user['password'] = Hash::make($user['password']);
        $user->save();

        return $user;
    }
}
