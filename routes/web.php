<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'show'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/articles/show/{id}', [App\Http\Controllers\ArticleController::class, 'show']);
Route::get('/articles/edit', [App\Http\Controllers\ArticleController::class, 'edit']);
Route::get('/articles/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit']);
Route::get('/articles/search', [App\Http\Controllers\ArticleController::class, 'show']);

Route::post('/articles', [App\Http\Controllers\ArticleController::class, 'store']);

Route::post('/reply/store', [App\Http\Controllers\CommentController::class, 'store']);
Route::put('/reply/edit', [App\Http\Controllers\CommentController::class, 'edit']);
Route::delete('/reply/del', [App\Http\Controllers\CommentController::class, 'remove']);

require __DIR__.'/auth.php';
