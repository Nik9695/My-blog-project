<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



$unauthenticatedRoutes = ['index', 'show'];

Route::middleware('auth:sanctum')->group(function () use ($unauthenticatedRoutes) {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('articles', ArticleController::class)->except($unauthenticatedRoutes); //+
    Route::apiResource('comments', CommentController::class)->except($unauthenticatedRoutes);
    Route::apiResource('users', UserController::class)->except($unauthenticatedRoutes);
});
Route::apiResource('users', UserController::class)->only($unauthenticatedRoutes);
Route::apiResource('comments', CommentController::class)->only($unauthenticatedRoutes);
Route::apiResource('articles', ArticleController::class)->only($unauthenticatedRoutes);
Route::apiResource('categories', CategoryController::class)->only($unauthenticatedRoutes);

Route::apiResource('users.articles', UserArticleController::class)->only($unauthenticatedRoutes);
Route::apiResource('articles.comments', ArticleCommentController::class)->only($unauthenticatedRoutes);

Route::post('/registration', [UserController::class, 'store']);
Route::post('/authenticate', [AuthController::class, 'authenticate']);
