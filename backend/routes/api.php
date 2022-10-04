<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// don't forget the dot!
Route::name('api.')->group(function () {
    // see documentation about what Route::resource does
    // https://laravel.com/docs/9.x/controllers#actions-handled-by-resource-controller
    // could use "apiResource" as well
    // https://laravel.com/docs/9.x/controllers#restful-partial-resource-routes


    Route::resource('articles', ArticleController::class)->except([
        'create',
        'edit',
    ]);


    Route::get('/users/{user:slug}', function (User $user) {
        return $user;
    })->name('users.show');

    Route::post('/users', function (StoreUserRequest $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'slug' => 'required',
            'password' => 'forbidden'
        ]);

        // we will learn how to properly handle passwords later in the course:)
        $validated['password'] = Hash::make('never store passwords in plaintext');

        $user = new User($validated);
        $user->save();

        return $user;
    })->name('users.store');

    Route::get('/{author:slug}/articles', function (User $author) {
        return $author->articles;
    })->name('author.articles');

    Route::resource('comments', CommentController::class)->except([
        'create',
        'edit',
    ]);

    Route::post('/authenticate', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)]
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['code' => 403, 'message' => 'invalid credentials'], 403);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        return $user->createToken('auth_token')->plainTextToken;
    });

});

    //Route::apiResource('articles', ArticleController::class);
