<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UnsubscribeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}',  [PostController::class, 'show']);
Route::post('/comments/{post:slug}/create',  [CommentController::class, 'store']);

Route::post('/newsletter',  NewsLetterController::class);
Route::get('/unsubscribe',  UnsubscribeController::class);

Route::get('/admin/dashboard',  [AdminController::class, 'index'])->middleware('auth');
Route::get('/admin/posts/new',  [AdminController::class, 'create'])->middleware('auth');
Route::post('/admin/posts/new',  [AdminController::class, 'store'])->middleware('auth');
Route::get('/admin/posts/{post:id}/edit',  [AdminController::class, 'edit'])->middleware('auth');
Route::patch('/admin/posts/{post:id}/edit',  [AdminController::class, 'update'])->middleware('auth');
Route::delete('/admin/posts/{post:id}',  [AdminController::class, 'destroy'])->middleware('auth');

require __DIR__.'/auth.php';
