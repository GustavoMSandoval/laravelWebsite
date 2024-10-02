<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

Route::get('/home',function () {
    //$posts = Post::all();
    //$posts = Post::where('user_id', Auth::id())->get();

    $posts = [];
    if(Auth::check()) {
       //$posts = Auth::user()->usersPosts()->latest()->get();
       $posts = Post::all();
       
    }
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class,'register']);

Route::post('/logout',[UserController::class,'logout']);

Route::post('/login',[UserController::class,'login']);

Route::post('/create-post', [PostController::class, 'createPost']);

Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatedPost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);