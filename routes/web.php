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

// home
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'show'])
->middleware(['auth', 'verified'])->name('dashboard');

// home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'show'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/api/map', [App\Http\Controllers\MapManageController::class, 'view']);
Route::get('/api/map/test', [App\Http\Controllers\MapManageController::class, 'show']);
Route::get('/api/map/show', [App\Http\Controllers\MapManageController::class, 'show']);
Route::get('/api/map/edit', [App\Http\Controllers\MapRegisterController::class, 'view']);
//Route::post('/api/map/store', [App\Http\Controllers\MapRegisterController::class, 'store']);
Route::post('/api/map/store', [App\Http\Controllers\MapRegisterController::class, 'store']);

Route::get('/api/record', [App\Http\Controllers\RecordManagerController::class, 'view']);
Route::get('/api/record/show', [App\Http\Controllers\RecordManagerController::class, 'show']);
Route::get('/api/record/edit', [App\Http\Controllers\RecordRegisterController::class, 'view']);
Route::post('/api/record/store', [App\Http\Controllers\RecordRegisterController::class, 'store']);


Route::get('/articles/show/{id}', [App\Http\Controllers\ArticleController::class, 'show']);
Route::get('/articles/edit', [App\Http\Controllers\ArticleController::class, 'edit']);
Route::get('/articles/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit']);
Route::get('/articles/search', [App\Http\Controllers\ArticleController::class, 'show']);

Route::post('/articles', [App\Http\Controllers\ArticleController::class, 'store']);

Route::post('/reply/store', [App\Http\Controllers\CommentController::class, 'store']);
Route::put('/reply/edit', [App\Http\Controllers\CommentController::class, 'edit']);
Route::delete('/reply/del', [App\Http\Controllers\CommentController::class, 'remove']);

require __DIR__.'/auth.php';
