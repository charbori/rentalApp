<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index() {
        return view('home');
    }

    public function show(Request $request, $articleId = null) {
        //$cacheKey = cache_key('articles.index');
        $query = $articleId ? \App\Models\Article::whereId($articleId) : DB::table('article')->paginate(15);

        $articles = $query->orderBy(
            $request->input('sort', 'created_at'),
            $request->input('order', 'desc')
        );

        //$articles = $this->cache($cacheKey, 5, $query, 'paginate', 3);

        return view('home', compact('articles'));
    }
}
