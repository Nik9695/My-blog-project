<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleLikeController;
use App\Http\Controllers\ArticleReactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\CommentReactionController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



$unauthenticatedRoutes = ['index', 'show'];

Route::middleware('auth:sanctum')->group(function () use ($unauthenticatedRoutes) {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('articles', ArticleController::class)->except($unauthenticatedRoutes);

    Route::apiResource('comments', CommentController::class)->except($unauthenticatedRoutes);

    Route::apiResource('users', UserController::class)->except($unauthenticatedRoutes);

    Route::apiResource('articles.comments', ArticleCommentController::class)->shallow()->except($unauthenticatedRoutes);
});


Route::apiResource('comments', CommentController::class)->only($unauthenticatedRoutes);

Route::apiResource('articles', ArticleController::class)->only($unauthenticatedRoutes);

Route::apiResource('users', UserController::class)->only($unauthenticatedRoutes);

Route::apiResource('users.articles', UserArticleController::class)->only($unauthenticatedRoutes);
Route::apiResource('users.comments', UserCommentController::class)->shallow()->only($unauthenticatedRoutes);
Route::apiResource('articles.comments', ArticleCommentController::class)->only($unauthenticatedRoutes);


Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::post('/registration', [UserController::class, 'store']);

Route::apiResource('categories', CategoryController::class)->only($unauthenticatedRoutes);

Route::post('/articles/{article}/reactions', [ArticleReactionController::class, 'store'])->middleware('auth:sanctum');
Route::get('/articles/{article}/reactions', [ArticleReactionController::class, 'index']);

Route::post('/comments/{comment}/reactions', [CommentReactionController::class, 'store'])->middleware('auth:sanctum');
Route::get('/comments/{comment}/reactions', [CommentReactionController::class, 'index']);
