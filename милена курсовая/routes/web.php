<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\Route;

Route::get('/', [indexController::class, 'index'])->name('index');



//коментарии
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


// регистрация

Route::get('/register', function() {return view('auth.register');}) -> name('register');

Route::post('/register', [UserController::class, 'register']);

Route::get('/login', function() {return view('auth.login');}) -> name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout']) -> name('logout') -> middleware('auth');

// Пути постов
// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create']) -> name('posts.create');

Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::post('/posts/{id}/edit', [PostController::class, 'update'])->name('posts.update');

Route::resource('posts', PostController::class)->except(['create', 'store']);

Route::resource('posts', PostController::class);

// ИЛИ если определяете вручную, убедитесь что есть:
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Темы

Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');

Route::get('/themes/create', [ThemeController::class, 'create']) -> name('themes.create');

Route::post('/themes/create', [ThemeController::class, 'store'])->name('themes.store');

Route::get('/themes/{id}', [ThemeController::class, 'show'])->name('themes.show');

Route::get('/themes/{id}/edit', [ThemeController::class, 'edit'])->name('themes.edit');

Route::post('/themes/{id}/edit', [ThemeController::class, 'update'])->name('themes.update');

Route::delete('/themes/{id}', [ThemeController::class, 'destroy'])->name('themes.destroy');


//  Лайки

Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::delete('/posts/{post}/like', [PostController::class, 'unlike'])->name('posts.unlike');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/', [PostController::class, 'index'])->name('index'); 
