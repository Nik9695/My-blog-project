<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Utils\StringUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::post('/registration', [UserController::class, 'store']);
