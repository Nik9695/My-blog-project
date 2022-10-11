<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

$unauthenticatedRoutes = ['index', 'show'];

Route::middleware('auth:sanctum')->group(function () use ($unauthenticatedRoutes) {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('articles', ArticleController::class)->except($unauthenticatedRoutes);
    Route::apiResource('comments', CommentController::class)->except($unauthenticatedRoutes);
    Route::apiResource('articles.comments', ArticleCommentController::class)->shallow()->except($unauthenticatedRoutes);
});

Route::apiResource('comments', CommentController::class)->only($unauthenticatedRoutes);
Route::apiResource('articles', ArticleController::class)->only($unauthenticatedRoutes);
Route::apiResource('users', UserController::class)->only($unauthenticatedRoutes);

Route::apiResource('users.articles', UserArticleController::class)->shallow()->only($unauthenticatedRoutes);
Route::apiResource('users.comments', UserCommentController::class)->shallow()->only($unauthenticatedRoutes);
Route::apiResource('articles.comments', ArticleCommentController::class)->shallow()->only($unauthenticatedRoutes);

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

/* Route::post('/registration', function (StoreUserRequest $request) {
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'slug' => 'required',
        'password' => 'required'
    ]);

    $validated['password'] = Hash::make($validated['password']);

    $user = new User($validated);
    $user->save();

    return $user;
})->name('users.store'); */
