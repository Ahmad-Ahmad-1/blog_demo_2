<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PostController::class, 'latestPosts'])->name('home');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
  Route::get('/posts/my-posts', [PostController::class, 'myPosts'])->name('posts.my_posts');
  Route::resource('/posts', PostController::class)->except(['show', 'destroy']);
  Route::delete('/posts/{post}/{redirect?}', [PostController::class, 'destroy'])->name('posts.destroy');

  Route::get('/roles/search', [RoleController::class, 'search'])->name('roles.search');
  Route::resource('/roles', RoleController::class);

  Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
  Route::resource('/users', UserController::class);

  Route::get('/test', function () {
    $post = Post::find(40);
    return view('test', ['post' => $post]);
  })->name('test');
});

Route::get('/posts/{post}/{redirect?}', [PostController::class, 'show'])->name('posts.show');

require __DIR__ . '/auth.php';

/*
  - for pushing changes:
    * git add .
    * git commit -m "commit message"
    * git push origin main (or HEAD:MASTER as you did the first time).
*/
