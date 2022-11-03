<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function __construct()
    {
        $this->authorizeResource(User::class, options: ['except' => ['index', 'show', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        if ($request->avatar) {
            $path = $request->file('avatar')->store('public/images');
            if (!$path) {
                return response()->json(['msg' => 'avatar could not be saved'], 500);
            }
            $validated['avatar_path'] = $path;
        } else {
            $path = 'public/images/default-user-icon.png';
            $validated['avatar_path'] = $path;
        }
        $user = new User($validated);
        $user->save();

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        if ($request->password) {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->avatar) {
            $path = $request->file('avatar')->store('images', ['disk' => 'public']);

            if (!$path) {
                return response()->json(['msg' => 'avatar could not be saved'], 500);
            }

            $validated['avatar_path'] = $path;
        }
        if (!$user->update($validated)) {
            return response()->json(['msg' => 'could not update user'], 500);
        }

        return $user;
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
