<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    //
    public function show(\App\Models\Article $article, $id) {
        $article = \App\Models\Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function edit(\App\Models\Article $article) {
        $comments = $article->comments()->with('replies')->whereNull('parent_id')->latest()->get();

        $article->view_count += 1;
        $article->save();

        return view('articles.edit', compact('article'));
    }
}
