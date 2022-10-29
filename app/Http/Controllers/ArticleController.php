<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //
    public function show(\App\Models\Article $article, $id) {
        $article = \App\Models\Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function edit(\App\Models\Article $article, $id = '') {
        if (Auth::check() === false) {
            return redirect('home');
        }
        $data = array(  "title" => "",
                        "content" => "");
        $article = \App\Models\Article::findOr($id, function() {
            return view('articles.edit', ["title" => "",
                                        "content" => ""]);
        });
        $data["title"] = $article->title;
        $data["content"] = $article->content;
        return view('articles.edit', $data);
    }

    public function store(Request $request) {
        if (Auth::check() === false) {
            return redirect('home');
        }
        $id = Auth::id();
        $article = \App\Models\Article::create([
            "title" => $request->title,
            "content" => $request->content,
            "user_id" => $id
        ]);
        return view('articles.show', compact('article'));
    }
}
